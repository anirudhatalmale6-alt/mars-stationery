@extends('layouts.app')

@section('title', 'My Profile - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <a href="{{ url('/account') }}" class="hover:text-primary transition">Account</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Profile</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        @include('account._sidebar')

        <div class="flex-1 space-y-6">
            {{-- Personal Info --}}
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h2 class="font-heading text-xl font-bold text-dark mb-6">Personal Information</h2>
                <form action="{{ url('/account/profile') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                            <input type="text" name="name" required value="{{ old('name', auth()->user()->name) }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                            <input type="email" name="email" required value="{{ old('email', auth()->user()->email) }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                    </div>
                    <button type="submit" class="bg-primary hover:bg-red-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition">
                        Update Profile
                    </button>
                </form>
            </div>

            {{-- Change Password --}}
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <h2 class="font-heading text-xl font-bold text-dark mb-6">Change Password</h2>
                <form action="{{ url('/account/profile') }}" method="POST" class="space-y-5">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="name" value="{{ auth()->user()->name }}">
                    <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                            <input type="password" name="current_password"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div></div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                            <input type="password" name="new_password"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('new_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                    </div>
                    <button type="submit" class="bg-dark hover:bg-gray-800 text-white px-6 py-2.5 rounded-lg text-sm font-medium transition">
                        Change Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
