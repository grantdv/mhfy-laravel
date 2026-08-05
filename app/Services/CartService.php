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
     * Retrieves the current cart count (static method for views/routes).
     * This returns the total quantity of all items, not just unique items.
     * 
     * @return int
     */
    public static function getCartCount(): int
    {
        $cart = Session::get('cart', []);
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['quantity'] ?? 0);
        }
        return $total;
    }

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
     */
    public function addProduct(int $productId, int $quantity = 1, ?string $name = null, ?float $price = null, ?string $image = null): void
    {
        $cart = Session::get('cart', []);
        
        if (isset($cart[$productId])) {
            // Update existing item
            $cart[$productId]['quantity'] += $quantity;
            if ($name) $cart[$productId]['name'] = $name;
            if ($price) $cart[$productId]['price'] = $price;
            if ($image) $cart[$productId]['image'] = $image;
        } else {
            // Add new item
            $cart[$productId] = [
                'id' => $productId,
                'name' => $name ?? 'Product #' . $productId,
                'price' => $price ?? 0.00,
                'quantity' => $quantity,
                'image' => $image,
            ];
        }
        
        Session::put('cart', $cart);
    }

    /**
     * Removes a product from the cart.
     * 
     * @param int $productId
     */
    public function removeProduct(int $productId): void
    {
        $cart = Session::get('cart', []);
        unset($cart[$productId]);
        Session::put('cart', $cart);
    }

    /**
     * Clears all items from the cart.
     */
    public function clear(): void
    {
        Session::forget('cart');
    }
}
