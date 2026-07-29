<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Handles the administrative dashboard landing page.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     * 
     * @return View
     */
    public function index(): View
    {
        return view('admin.dashboard');
    }
}
