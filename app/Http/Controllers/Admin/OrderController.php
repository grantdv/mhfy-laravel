<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     */
    public function index(): \Illuminate\View\View
    {
        $orders = OrderRequest::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show(OrderRequest $order): \Illuminate\View\View
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Trigger the invoicing process for an order.
     */
    public function invoice(OrderRequest $order, OrderService $orderService): RedirectResponse
    {
        try {
            $orderService->invoice($order);
            return back()->with('success', "Order #{$order->id} has been invoiced successfully.");
        } catch (\Exception $e) {
            Log::error("Failed to invoice order #{$order->id}: " . $e->getMessage());
            return back()->with('error', "Failed to invoice order #{$order->id}: " . $e->getMessage());
        }
    }
}