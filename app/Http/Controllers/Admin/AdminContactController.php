<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\ContactReply;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);
        return view('admin.contacts.index', compact('messages'));
    }

    public function show(ContactMessage $contact)
    {
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function reply(Request $request, ContactMessage $contact)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:5000',
        ]);

        $contact->update([
            'admin_reply' => $request->admin_reply,
            'replied_at' => now(),
        ]);

        Mail::to($contact->email)->send(new ContactReply($contact));

        return redirect()->route('admin.contacts.show', $contact)->with('success', 'Reply sent successfully!');
    }
}
