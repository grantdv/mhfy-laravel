<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

/**
 * Handles the general contact form for the website.
 */
class ContactController extends Controller
{
    /**
     * Display the contact form.
     * 
     * @return \Illuminate\View\View
     */
    public function show(): \Illuminate\View\View
    {
        return view('contact');
    }

    /**
     * Handle the contact form submission.
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function submit(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|min:10',
        ]);

        // Log the message directly to bypass SMTP issues during development
        Log::info("Contact Form Submission:", [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message']
        ]);

        return redirect()->back()->with('success', 'Your message has been sent! We will get back to you soon.');
    }
}
