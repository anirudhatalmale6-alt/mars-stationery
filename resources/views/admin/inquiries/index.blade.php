@extends('admin.layouts.app')
@section('title', 'Bulk Inquiries')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-800">Bulk Inquiries</h2>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Items</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($inquiries as $inquiry)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3 text-gray-500">{{ $inquiry->id }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $inquiry->name }}</td>
                            <td class="px-4 py-3 text-gray-500">{{ $inquiry->email }}</td>
                            <td class="px-4 py-3 text-gray-700">{{ $inquiry->items->count() }} items</td>
                            <td class="px-4 py-3">
                                @php
                                    $colors = ['pending' => 'yellow', 'reviewed' => 'blue', 'quoted' => 'purple', 'accepted' => 'green', 'rejected' => 'red'];
                                    $color = $colors[$inquiry->status] ?? 'gray';
                                @endphp
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $color }}-100 text-{{ $color }}-800">{{ ucfirst($inquiry->status) }}</span>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $inquiry->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-3 text-right">
                                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">View</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="px-4 py-8 text-center text-gray-500">No inquiries yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($inquiries->hasPages())
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $inquiries->links() }}
            </div>
        @endif
    </div>
@endsection
