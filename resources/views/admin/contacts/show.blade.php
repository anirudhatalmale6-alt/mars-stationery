@extends('admin.layouts.app')
@section('title', 'Message from ' . $contact->name)

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-gray-500 hover:text-gray-700">&larr; Back to Messages</a>
    </div>

    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-800">{{ $contact->subject }}</h2>
                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $contact->is_read ? 'bg-gray-100 text-gray-600' : 'bg-red-100 text-red-800' }}">
                    {{ $contact->is_read ? 'Read' : 'Unread' }}
                </span>
            </div>

            <dl class="grid grid-cols-2 gap-4 text-sm mb-6">
                <div><dt class="text-gray-500">Name</dt><dd class="font-medium text-gray-900">{{ $contact->name }}</dd></div>
                <div><dt class="text-gray-500">Email</dt><dd class="text-gray-900">{{ $contact->email }}</dd></div>
                <div><dt class="text-gray-500">Phone</dt><dd class="text-gray-900">{{ $contact->phone ?? 'N/A' }}</dd></div>
                <div><dt class="text-gray-500">Date</dt><dd class="text-gray-900">{{ $contact->created_at->format('d M Y, h:i A') }}</dd></div>
            </dl>

            <div class="border-t border-gray-200 pt-4">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Message</h3>
                <p class="text-sm text-gray-800 whitespace-pre-line leading-relaxed">{{ $contact->message }}</p>
            </div>

            <div class="mt-6">
                <a href="mailto:{{ $contact->email }}" class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Reply via Email
                </a>
            </div>
        </div>
    </div>
@endsection
