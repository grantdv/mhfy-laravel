<?php

namespace App\View\Composers;

use App\Services\CartService;

class CartCountComposer
{
    public function compose($view)
    {
        $view->data['cartCount'] = CartService::getCartCount();
    }
}
