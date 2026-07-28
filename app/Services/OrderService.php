<?php

namespace App\Services;

use App\Models\OrderRequest;
use App\Models\OrderItem;
use App\Models\Product;
use App\Mail\PaymentInvoice;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

/**
 * Orchestrates the business logic for order lifecycle management.
 * 
 * This service handles the transition of OrderRequests through their 
 * states (pending $\rightarrow$ invoiced $\rightarrow$ paid) and coordinates
 * between the database, inventory logic, and the Stripe communication layer.
 */
class OrderService
{
    protected StripeService $stripeService;

    /**
     * @param StripeService $stripeService
     */
    public function __construct(StripeService $stripeService)
    {
        $this->stripeService = $stripeService;
    }

    /**
     * Creates a new order from a customer inquiry.
     * 
     * It handles the logic for both product-based orders (decrementing stock) 
     * and general inquiries (purely informational).
     * 
     * @param array $data
     * @param array $cartItems
     * @return OrderRequest
     * @throws \Exception
     */
    public function createOrder(array $data, array $cartItems): OrderRequest
    {
        return DB::transaction(function () use ($data, $cartItems) {
            $type = !empty($cartItems) ? 'product_order' : 'general_inquiry';

            $order = OrderRequest::create([
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'shipping_address' => $data['shipping_address'],
                'type' => $type,
                'message' => $data['message'] ?? null,
                'status' => 'pending',
            ]);

            if ($type === 'product_order') {
                foreach ($cartItems as $item) {
                    $product = Product::findOrFail($item['id']);
                    
                    $isBackordered = $product->stock_quantity <= 0;

                    // Decrement stock only if it's available
                    if (!$isBackordered) {
                        $product->decrement('stock_quantity', $item['quantity']);
                    }

                    OrderItem::create([
                        'order_request_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $item['quantity'],
                        'price_at_submission' => $product->price,
                        'is_backordered' => $isBackordered,
                    ]);
                }
            }

            return $order;
        });
    }

    /**
     * Transitions an order to the 'invoiced' state and sends a payment link.
     * 
     * This triggers the Stripe session creation and sends the PaymentInvoice email.
     * 
     * @param OrderRequest $order
     * @return void
     * @throws \Exception
     */
    public function invoiceOrder(OrderRequest $order): void
    {
        if ($order->status !== 'pending') {
            throw new \Exception("Only pending orders can be invoiced.");
        }

        // 1. Update status to 'invoiced'
        $order->update(['status' => 'invoiced']);

        // 2. Create Stripe Checkout Session
        $successUrl = route('payment.success', ['order_id' => $order->id]);
        $cancelUrl = route('payment.cancel', ['order_id' => $order->id]);

        $sessionId = $this->stripeService->createCheckoutSession($order, $successUrl, $cancelUrl);

        // 3. Store Stripe Session ID for webhook tracking
        $order->update(['stripe_session_id' => $sessionId]);

        // 4. Send the automated PaymentInvoice email
        Mail::to($order->email)->send(new PaymentInvoice($order, $sessionId));

        Log::info("Order {$order->id} has been invoiced and payment link sent to {$order->email}.");
    }
}
