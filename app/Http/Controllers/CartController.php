<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Add a product to the cart.
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $this->cartService->addToCart($request->product_id, $request->quantity);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Get the current cart contents.
     */
    public function show(): \Illuminate\View\View
    {
        $cart = $this->cartService->getCart();
        return view('cart.index', compact('cart'));
    }

    /**
     * Clear the cart.
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clear();
        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
