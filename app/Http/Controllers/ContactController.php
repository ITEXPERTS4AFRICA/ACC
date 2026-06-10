<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;

class ContactController extends Controller
{
    public function submit(Request $request) {
        // Honeypot anti-spam
        if ($request->filled('website')) {
            return redirect()->route(app()->getLocale().'.contact')->with('success', true);
        }

        // Rate limiting : 3 messages par heure par IP
        $key = 'contact:'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 3)) {
            return back()->withErrors(['email' => __('Trop de tentatives. Réessayez dans une heure.')]);
        }
        RateLimiter::hit($key, 3600);

        $validated = $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email|max:150',
            'company' => 'nullable|string|max:150',
            'country' => 'nullable|string|max:100',
            'subject' => 'required|string|max:200',
            'message' => 'required|string|max:3000',
        ]);

        $msg = ContactMessage::create($validated);

        try {
            Mail::to(config('mail.contact_to', 'contact@atlantic-cocoacorporation.net'))
                ->send(new ContactMail($msg));
        } catch (\Throwable) {}

        return redirect()->route(app()->getLocale().'.contact')
               ->with('success', __('Votre message a bien été envoyé.'));
    }
}
