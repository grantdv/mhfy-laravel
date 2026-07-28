<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Handles public and admin-facing product catalog actions.
 * 
 * This controller manages the public catalog and the admin product management.
 */
class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     * 
     * Publicly filters products by `is_active` status.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $products = Product::where('is_active', true)->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Display the specified product.
     * 
     * @param Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): \Illuminate\View\View
    {
        return view('products.show', compact('product'));
    }

    /**
     * Store a new product.
     * 
     * Admin-only. Handles file upload for product images.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            if ($product_id = $request->input('product_id') && $product = Product::find($product_id)) {
                if ($product->image) {
                    \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
                }
            }
            $path = $request->file('image')->store('products', 'public');
        }

        $product = Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'],
            'image' => $path,
            'is_active' => true,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' created successfully.");
    }

    /**
     * Update the specified product.
     * 
     * Admin-only. Handles file upload for product images and
     * status/stock updates.
     * 
     * @param Request $request
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Product $product): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_active' => 'nullable',
            'image' => 'nullable|image|max:2048',
        ]);

        $path = $product->image;

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock_quantity' => $validated['stock_quantity'],
            'is_active' => $request->has('is_active'),
            'image' => $path,
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', "Product '{$product->name}' updated successfully.");
    }

    /**
     * Remove the specified product.
     * 
     * Admin-only. Handles file deletion.
     * 
     * @param Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        if ($product->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Product #{$product->id} deleted successfully.");
    }
}
