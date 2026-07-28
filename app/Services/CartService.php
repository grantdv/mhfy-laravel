<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

class CartService
{
    private const SESSION_KEY = 'mhfy_cart';

    /**
     * Add a product to the cart.
     *
     * @param int $productId
     * @param int $quantity
     * @return void
     */
    public function addToCart(int $productId, int $quantity = 1): void
    {
        $cart = Session::get(self::SESSION_KEY, []);
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'quantity' => $quantity,
            ];
        }

        Session::put(self::SESSION_KEY, $cart);
    }

    /**
     * Get all items in the cart.
     *
     * @return array
     */
    public function getCart(): array
    {
        return Session::get(self::SESSION_KEY, []);
    }

    /**
     * Clear the cart.
     *
     * @return void
     */
    public function clear(): void
    {
        Session::forget(self::SESSION_KEY);
    }

    /**
     * Get total count of items in the cart.
     *
     * @return int
     */
    public function count(): int
    {
        $cart = $this->getCart();
        $count = 0;
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        return $count;
    }
}
