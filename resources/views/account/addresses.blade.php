@extends('layouts.app')

@section('title', 'My Addresses - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/account') }}" class="hover:text-primary transition">Account</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Addresses</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        @include('account._sidebar')

        <div class="flex-1" x-data="{ showForm: false, editId: null }">
            <div class="flex items-center justify-between mb-6">
                <h2 class="font-heading text-xl font-bold text-dark">My Addresses</h2>
                <button @click="showForm = !showForm; editId = null" class="bg-primary hover:bg-[#d1405b] text-white px-5 py-2 rounded-lg text-sm font-medium transition">
                    <i class="fas fa-plus mr-1"></i> Add Address
                </button>
            </div>

            {{-- Add Form --}}
            <div x-show="showForm && !editId" x-cloak class="bg-white rounded-xl border border-gray-100 p-6 mb-6">
                <h3 class="font-heading font-semibold text-dark mb-4">New Address</h3>
                <form action="{{ url('/account/addresses') }}" method="POST" class="grid md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Label *</label>
                        <input type="text" name="label" required placeholder="e.g. Home, Office" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                        <input type="text" name="name" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                        <input type="tel" name="phone" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 1 *</label>
                        <input type="text" name="address_line_1" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address Line 2</label>
                        <input type="text" name="address_line_2" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                        <input type="text" name="city" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                        <input type="text" name="state" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Postal Code *</label>
                        <input type="text" name="postal_code" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_default" value="1" class="text-primary rounded focus:ring-primary">
                        <label class="text-sm text-gray-600">Set as default address</label>
                    </div>
                    <div class="md:col-span-2 flex gap-3">
                        <button type="submit" class="bg-primary hover:bg-[#d1405b] text-white px-6 py-2.5 rounded-lg text-sm font-medium transition">Save Address</button>
                        <button type="button" @click="showForm = false" class="px-6 py-2.5 border border-gray-200 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">Cancel</button>
                    </div>
                </form>
            </div>

            {{-- Address List --}}
            @if($addresses->count() > 0)
                <div class="grid md:grid-cols-2 gap-4">
                    @foreach($addresses as $addr)
                        <div class="bg-white rounded-xl border border-gray-100 p-5 relative {{ $addr->is_default ? 'ring-2 ring-primary/30' : '' }}">
                            @if($addr->is_default)
                                <span class="absolute top-3 right-3 bg-primary text-white text-[10px] font-bold px-2 py-0.5 rounded">DEFAULT</span>
                            @endif
                            <h4 class="font-semibold text-dark text-sm mb-2">{{ $addr->label }}</h4>
                            <div class="text-sm text-gray-500 space-y-0.5">
                                <p class="font-medium text-gray-700">{{ $addr->name }}</p>
                                <p>{{ $addr->phone }}</p>
                                <p>{{ $addr->address_line_1 }}</p>
                                @if($addr->address_line_2) <p>{{ $addr->address_line_2 }}</p> @endif
                                <p>{{ $addr->city }}, {{ $addr->state }} {{ $addr->postal_code }}</p>
                            </div>
                            <div class="flex gap-3 mt-4">
                                <form action="{{ url('/account/addresses/' . $addr->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Delete this address?')" class="text-xs text-red-500 hover:underline">
                                        <i class="fas fa-trash-alt mr-1"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-100 p-12 text-center">
                    <i class="fas fa-map-marker-alt text-4xl text-gray-200 mb-3"></i>
                    <h3 class="font-heading text-lg font-semibold text-gray-500">No addresses saved</h3>
                    <p class="text-gray-400 text-sm mt-1">Add your first delivery address above.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
