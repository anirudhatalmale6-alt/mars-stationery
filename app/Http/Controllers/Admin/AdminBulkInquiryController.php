<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BulkInquiry;
use Illuminate\Http\Request;

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
            'status' => 'required|string|in:pending,reviewed,quoted,accepted,rejected',
        ]);

        $inquiry->update($validated);

        return redirect()->route('admin.inquiries.show', $inquiry)->with('success', 'Status updated successfully.');
    }
}
