<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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

        // In a real app, you'd send this to a specific address
        // For now, we use the LOG mailer for development
        Mail::raw($validated['message'], function ($message) use ($validated) {
            $message->to('admin@mayharmonyfindyou.com')
                    ->subject("Contact Form: " . $validated['name']);
        });

        return redirect()->back()->with('success', 'Your message has been sent! We will get back to you soon.');
    }
}
