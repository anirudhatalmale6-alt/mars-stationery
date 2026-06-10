<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\BulkInquiryReply;
use App\Models\BulkInquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminBulkInquiryController extends Controller
{
    public function index()
    {
        $inquiries = BulkInquiry::with('items')->latest()->paginate(20);
        return view('admin.inquiries.index', compact('inquiries'));
    }

    public function show(BulkInquiry $inquiry)
    {
        $inquiry->load('items.product');
        return view('admin.inquiries.show', compact('inquiry'));
    }

    public function updateStatus(Request $request, BulkInquiry $inquiry)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:pending,reviewed,quoted,accepted,rejected,responded',
        ]);

        $inquiry->update($validated);

        return redirect()->route('admin.inquiries.show', $inquiry)->with('success', 'Status updated successfully.');
    }

    public function reply(Request $request, BulkInquiry $inquiry)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:5000',
        ]);

        $inquiry->update([
            'admin_reply' => $request->admin_reply,
            'replied_at' => now(),
            'status' => 'responded',
        ]);

        $inquiry->load('items');
        Mail::to($inquiry->email)->send(new BulkInquiryReply($inquiry));

        return redirect()->route('admin.inquiries.show', $inquiry)->with('success', 'Reply sent successfully!');
    }
}
