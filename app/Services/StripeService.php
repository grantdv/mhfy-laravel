<?php

namespace App\Services;

use Stripe\StripeClient;
use App\Models\OrderRequest;
use Illuminate\Support\Facades\Log;
use Exception;
use Stripe\Exception\ApiErrorException;

class StripeService
{
    protected StripeClient $stripe;

    public function __construct(?StripeClient $stripe = null)
    {
        $this->stripe = $stripe ?? new StripeClient(config('services.stripe.secret'));
    }

    /**
     * Create a Stripe Checkout Session for an OrderRequest.
     *
     * @param OrderRequest $orderRequest
     * @param string $successUrl
     * @param string $cancelUrl
     * @return string The Stripe Session ID
     * @throws Exception
     */
    public function createCheckoutSession(OrderRequest $orderRequest, string $successUrl, string $cancelUrl): string
    {
        $lineItems = $orderRequest->items->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => (int) ($item->price_at_submission * 100),
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        try {
            $session = $this->stripe->checkout->sessions->create([
                'payment_method_types' => ['card'],
                'line_items' => $lineItems,
                'mode' => 'payment',
                'success_url' => $successUrl . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => $cancelUrl,
                'metadata' => ['order_id' => (string) $orderRequest->id],
            ]);

            Log::info("Stripe session successfully created for Order {$orderRequest->id}: {$session->id}");

            return $session->id;
        } catch (ApiErrorException $e) {
            Log::error("Stripe error during session creation for Order {$orderRequest->id}: {$e->getMessage()}");
            throw $e;
        } catch (Exception $e) {
            Log::error("Unexpected error during Stripe session creation for Order {$orderRequest->id}: {$e->getMessage()}");
            throw $e;
        }
    }
}
