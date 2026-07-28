<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderRequest;
use App\Services\OrderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Handles administrative actions for orders.
 * 
 * This controller provides the dashboard for the concierge team to 
 * monitor incoming inquiries and trigger the payment workflow.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $orders = OrderRequest::latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     * 
     * @param OrderRequest $order
     * @return \Illuminate\View\View
     */
    public function show(OrderRequest $order): \Illuminate\View\View
    {
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Trigger the invoicing process for an order.
     * 
     * This action transitions the order to 'invoiced' status and 
     * sends the PaymentInvoice email to the customer.
     * 
     * @param OrderRequest $order
     * @param OrderService $orderService
     * @return RedirectResponse
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
