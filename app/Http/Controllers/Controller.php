<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Get the current cart item count.
     *
     * @return int
     */
    protected function getCartCount(): int
    {
        $cart = \App\Services\CartService::getCart();
        return count($cart);
    }

    //
}
