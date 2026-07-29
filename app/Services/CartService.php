<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

/**
 * Manages the shopping cart state for guest users.
 * 
 * Uses Laravel's session storage to track products and quantities 
 * during the inquiry checkout flow.
 */
class CartService
{
    /**
     * Retrieves the current cart items from the session.
     * 
     * @return array
     */
    public function getCart(): array
    {
        return Session::get('cart', []);
    }

    /**
     * Adds a product to the cart or updates quantity if it exists.
     * 
     * @param int $productId
     * @param int $quantity
     * @param string|null $name
     * @param float|null $price
     * @param string|null $image
     * @return void
     */
    public function addProduct(int $productId, int $quantity, ?string $name = null, ?float $price = null, ?string $image = null): void
    {
        $cart = $this->getCart();

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'quantity' => $quantity,
                'name' => $name ?? 'Product ' . $productId,
                'price' => $price ?? 0.00,
                'image' => $image,
            ];
        }

        Session::put('cart', $cart);
    }

    /**
     * Clears all items from the session-based cart.
     * 
     * @return void
     */
    public function clear(): void
    {
        Session::forget('cart');
    }
}
