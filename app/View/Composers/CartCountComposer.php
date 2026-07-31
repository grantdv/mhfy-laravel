<?php

namespace App\View\Composers;

use Illuminate\Support\Facades\Session;

class CartCountComposer
{
    public function compose($view)
    {
        $cart = Session::get('cart', []);
        $view->data['cartCount'] = count($cart);
    }
}
