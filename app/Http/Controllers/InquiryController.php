<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;

/**
 * Handles the guest inquiry and checkout flow.
 * 
 * This controller manages the transition from the product catalog 
 * to the final inquiry submission.
 */
class InquiryController extends Controller
{
    public function __construct(
        protected OrderService $orderService,
        protected CartService $cartService
    ) {}

    /**
     * Display the checkout form.
     *
     * @param string|null $productName
     * @return \Illuminate\View\View
     */
    public function create(?string $productName = null): \Illuminate\View\View
    {
        $cart = $this->cartService->getCart();
        $cartWithDetails = [];

        foreach ($cart as $id => $item) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $cartWithDetails[$id] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $product->price * $item['quantity'],
                ];
            }
        }

        $cartCount = count($cart);

        return view('inquiry', [
            'productName' => $productName,
            'cart' => $cartWithDetails,
            'cartCount' => $cartCount
        ]);
    }

    /**
     * Handle the checkout request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'shipping_address' => 'required|string|max:500',
            'message' => 'nullable|string',
        ]);

        $cartItems = $this->cartService->getCart();
        
        $type = !empty($cartItems) ? 'product_order' : 'general_inquiry';

        $order = $this->orderService->createOrder([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'shipping_address' => $validated['shipping_address'],
            'message' => $validated['message'] ?? null,
        ], $cartItems);

        $this->cartService->clear();

        Log::info("Order #{$order->id} created. Type: " . $order->type);

        return redirect()->route('inquiry.success', ['order_id' => $order->id])
            ->with('success', 'Your order has been received. We will contact you shortly.');
    }

    /**
     * Show a success page.
     */
    public function success($order_id): \Illuminate\View\View
    {
        $cartCount = CartService::getCartCount();
        return view('inquiry.success', compact('orderId', 'cartCount'));
    }
}
