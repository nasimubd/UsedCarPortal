<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Show the contact form.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('contact.show');
    }

    /**
     * Handle the contact form submission.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        // Store the contact message (optional)
        Contact::create($validated);

        // Send email to admin
        Mail::send('emails.contact', $validated, function ($message) use ($validated) {
            $message->from($validated['email'], $validated['name']);
            $message->to(config('mail.admin_address'), 'Admin')->subject($validated['subject'] ?? 'New Contact Message');
        });

        return back()->with('success', 'Your message has been sent successfully!');
    }
}
