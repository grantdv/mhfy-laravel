<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

/**
 * Handles shopping cart operations for guest users.
 * 
 * This controller manages the temporary session-based cart, 
 * allowing users to build a selection of products before 
 * proceeding to the inquiry submission.
 */
class CartController extends Controller
{
    public function __construct(
        protected CartService $cartService
    ) {}

    /**
     * Add a product to the cart.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = \App\Models\Product::find($request->product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        $this->cartService->addProduct($request->product_id, $request->quantity, $product->name, $product->price, $product->image);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Get the current cart contents.
     * 
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
    {
        $cart = $this->cartService->getCart();
        $cartCount = count($cart);
        return view('cart', compact('cart', 'cartCount'));
    }

    /**
     * Clear the cart.
     * 
     * @return RedirectResponse
     */
    public function clear(): RedirectResponse
    {
        $this->cartService->clear();
        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
