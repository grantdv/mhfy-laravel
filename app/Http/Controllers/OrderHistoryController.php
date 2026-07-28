<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

/**
 * Handles the retrieval and display of a customer's order history.
 * 
 * Provides the "Member" experience for customers who choose 
 * to log in, giving them a central place to monitor their inquiries.
 */
class OrderHistoryController extends Controller
{
    /**
     * Display the user's order history.
     * 
     * @return \Illuminate\View\View
     */
    public function index(): \Illuminate\View\View
    {
        $user = Auth::user();
        $orders = $user->orders()->latest()->paginate(10);

        return view('orders.history', compact('orders'));
    }
}
