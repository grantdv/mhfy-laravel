<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\CartService;

class ViewDataComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @param  mixed  $data
     * @return void
     */
    public function compose(View $view)
    {
        $view->share('cartCount', CartService::getCartCount());
    }
}
