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
        return \App\Services\CartService::getCartCount();
    }

    //
}
