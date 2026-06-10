<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormReceived;
use App\Models\ContactMessage;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::pluck('value', 'key');
        return view('contact', compact('settings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        $contact = ContactMessage::create($request->only(['name', 'email', 'phone', 'subject', 'message']));

        $adminEmail = SiteSetting::where('key', 'email')->value('value');
        if ($adminEmail) {
            Mail::to($adminEmail)->send(new ContactFormReceived($contact));
        }

        return back()->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
