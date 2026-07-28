<?php

namespace Tests\Feature;

use App\Models\OrderRequest;
use App\Models\Product;
use App\Models\OrderItem;
use App\Services\StripeService;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;
use Mockery;
use Tests\TestCase;

class StripeFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /**
     * Test that a Stripe Checkout Session is created with correct parameters.
     */
    public function test_stripe_session_creation()
    {
        // 1. Setup: Create Product and Order
        $product = Product::create([
            'name' => 'Test Product',
            'slug' => 'test-product',
            'description' => 'Test Description',
            'price' => 10.00,
            'stock_quantity' => 5,
        ]);

        $order = OrderRequest::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'shipping_address' => '123 Test St',
            'status' => 'pending',
        ]);

        $order->items()->create([
            'product_id' => $product->id,
            'quantity' => 2,
            'price_at_submission' => 10.00,
        ]);

        // 2. Mock StripeClient
        $mockSession = (object) [
            'id' => 'cs_test_123',
        ];

        $sessionsMock = Mockery::mock();
        $sessionsMock->shouldReceive('create')->once()->andReturn($mockSession);

        $checkoutMock = (object) ['sessions' => $sessionsMock];

        $mockStripeClient = Mockery::mock(\Stripe\StripeClient::class);
        $mockStripeClient->shouldReceive('__get')->with('checkout')->andReturn($checkoutMock);
        $mockStripeClient->shouldIgnoreMissing();

        // 3. Inject mock and run
        $service = new StripeService($mockStripeClient);
        $sessionId = $service->createCheckoutSession($order, 'http://success.com', 'http://cancel.com');

        // 4. Assert
        $this->assertEquals('cs_test_123', $sessionId);
    }

    /**
     * Test that the stripe webhook updates the order status to 'paid'.
     */
    public function test_stripe_webhook_updates_order_status()
    {
        // 1. Setup: Create Order
        $order = OrderRequest::create([
            'full_name' => 'John Doe',
            'email' => 'john@example.com',
            'shipping_address' => '123 Test St',
            'status' => 'pending',
        ]);

        // 2. Mock the Stripe event object
        $mockSession = (object) [
            'id' => 'cs_test_123',
            'metadata' => [
                'order_id' => (string) $order->id,
            ],
        ];

        $mockEvent = (object) [
            'type' => 'checkout.session.completed',
            'data' => (object) [
                'object' => $mockSession,
            ],
        ];

        // 3. Call the controller's processEvent method directly
        $controller = new StripeWebhookController();
        $response = $controller->processEvent($mockEvent);

        // 4. Assertions
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('paid', $order->fresh()->status);
    }
}
