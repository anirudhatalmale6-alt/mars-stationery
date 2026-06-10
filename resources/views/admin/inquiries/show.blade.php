@extends('admin.layouts.app')
@section('title', 'Inquiry #' . $inquiry->id)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.inquiries.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Inquiries</a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            {{-- Items --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Inquiry Items</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quantity</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($inquiry->items as $item)
                                <tr>
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ $item->product_name }}</td>
                                    <td class="px-4 py-3 text-gray-700">{{ $item->quantity }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @if($inquiry->message)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Message</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $inquiry->message }}</p>
                </div>
            @endif
        </div>

        <div class="space-y-6">
            {{-- Contact Info --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Contact Details</h3>
                <dl class="space-y-3 text-sm">
                    <div><dt class="text-gray-500">Name</dt><dd class="font-medium text-gray-900">{{ $inquiry->name }}</dd></div>
                    <div><dt class="text-gray-500">Email</dt><dd class="text-gray-900">{{ $inquiry->email }}</dd></div>
                    <div><dt class="text-gray-500">Phone</dt><dd class="text-gray-900">{{ $inquiry->phone ?? 'N/A' }}</dd></div>
                    <div><dt class="text-gray-500">Delivery Address</dt><dd class="text-gray-900">{{ $inquiry->delivery_address ?? 'N/A' }}</dd></div>
                    <div><dt class="text-gray-500">Date</dt><dd class="text-gray-900">{{ $inquiry->created_at->format('d M Y, h:i A') }}</dd></div>
                </dl>
            </div>

            {{-- Update Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Update Status</h3>
                <form method="POST" action="{{ route('admin.inquiries.updateStatus', $inquiry) }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 mb-3">
                        @foreach(['pending', 'reviewed', 'quoted', 'accepted', 'rejected', 'responded'] as $s)
                            <option value="{{ $s }}" {{ $inquiry->status == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Update Status</button>
                </form>
            </div>

            {{-- Reply --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ $inquiry->admin_reply ? 'Reply Sent' : 'Send Reply' }}</h3>

                @if($inquiry->admin_reply)
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                        <p class="text-xs text-green-600 font-medium mb-1">Replied {{ $inquiry->replied_at->format('d M Y, h:i A') }}</p>
                        <p class="text-sm text-gray-800 whitespace-pre-line">{{ $inquiry->admin_reply }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.inquiries.reply', $inquiry) }}">
                    @csrf
                    <textarea name="admin_reply" rows="4" class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500 mb-3" placeholder="Type your reply...">{{ old('admin_reply', $inquiry->admin_reply) }}</textarea>
                    @error('admin_reply')
                        <p class="text-red-600 text-xs mt-1 mb-2">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                        {{ $inquiry->admin_reply ? 'Update & Resend Reply' : 'Send Reply via Email' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
