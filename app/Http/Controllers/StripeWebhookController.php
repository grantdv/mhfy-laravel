<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Webhook;
use Stripe\Exception\SignatureVerificationException;
use App\Models\OrderRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;

/**
 * Handles incoming Stripe Webhook notifications.
 * 
 * This controller validates the Stripe signature and processes the 
 * `checkout.session.completed` event to update order statuses.
 */
class StripeWebhookController extends Controller
{
    /**
     * Handle the Stripe webhook event.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function handle(Request $request): JsonResponse
    {
        $payload = $request->getContent();
        $sig_header = $request->header('Stripe-Signature');
        $endpoint_secret = config('services.stripe.webhook_secret');

        if (!$endpoint_secret) {
            Log::error('Stripe Webhook: Webhook secret is not set in configuration.');
            return response()->json(['error' => 'Webhook secret not configured'], 500);
        }

        try {
            $event = Webhook::constructEvent($payload, $sig_header, $endpoint_secret);
            return $this->processEvent($event);
        } catch (SignatureVerificationException $e) {
            Log::error('Stripe Webhook: Invalid signature: ' . $e->getMessage());
            return response()->json(['error' => 'Invalid signature'], 400);
        } catch (\Exception $e) {
            Log::error('Stripe Webhook: Unexpected error: ' . $e->getMessage());
            return response()->json(['error' => 'Unexpected error'], 400);
        }
    }

    /**
     * Process the validated Stripe event.
     *
     * @param object $event
     * @return JsonResponse
     */
    public function processEvent($event): JsonResponse
    {
        switch ($event->type) {
            case 'checkout.session.completed':
                $this->handleCheckoutSessionCompleted($event->data->object);
                break;

            default:
                Log::info('Stripe Webhook: Unhandled event type: ' . $event->type);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Handle the checkout.session.completed event.
     * 
     * Extracts the `order_id` from metadata to update the correct 
     * record in our database.
     * 
     * @param object $session
     * @return void
     */
    protected function handleCheckoutSessionCompleted($session): void
    {
        if (isset($session->metadata['order_id'])) {
            $orderId = $session->metadata['order_id'];
            $order = OrderRequest::find($orderId);

            if ($order) {
                $order->update(['status' => 'paid']);
                Log::info("Stripe Webhook: Order {$orderId} marked as paid.");
            } else {
                Log::error("Stripe Webhook: Order {$orderId} not found for session {$session->id}.");
            }
        } else {
            Log::warning("Stripe Webhook: Checkout session {$session->id} did not contain an order_id in metadata.");
        }
    }
}
