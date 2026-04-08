@extends('layouts.app')

@section('title', 'Contact Us - Mars Stationery')

@section('content')

<div class="bg-light border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="{{ url('/') }}" class="hover:text-primary transition">Home</a>
            <i class="fas fa-chevron-right text-[10px]"></i>
            <span class="text-dark font-medium">Contact Us</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="text-center mb-10">
        <h1 class="font-heading text-3xl font-bold text-dark">Get In Touch</h1>
        <p class="text-gray-500 mt-2">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Contact Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-100 p-8">
                <form action="{{ url('/contact') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Your Name *</label>
                            <input type="text" name="name" required value="{{ old('name', auth()->user()->name ?? '') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" name="email" required value="{{ old('email', auth()->user()->email ?? '') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Subject *</label>
                            <input type="text" name="subject" required value="{{ old('subject') }}"
                                   class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">
                            @error('subject') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Message *</label>
                        <textarea name="message" rows="6" required
                                  class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-1 focus:ring-primary focus:outline-none">{{ old('message') }}</textarea>
                        @error('message') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-primary hover:bg-[#d1405b] text-white px-8 py-3 rounded-lg font-semibold transition">
                        <i class="fas fa-paper-plane mr-2"></i> Send Message
                    </button>
                </form>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-gray-100 p-6">
                <div class="space-y-5">
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark text-sm">Address</h4>
                            <p class="text-gray-500 text-sm mt-1">{{ $settings['address'] ?? '123 Main Street, Colombo 03, Sri Lanka' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone-alt text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark text-sm">Phone</h4>
                            <p class="text-gray-500 text-sm mt-1">{{ $settings['phone'] ?? '+94 11 234 5678' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark text-sm">Email</h4>
                            <p class="text-gray-500 text-sm mt-1">{{ $settings['email'] ?? 'info@mars.lk' }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-10 h-10 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-clock text-primary"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-dark text-sm">Business Hours</h4>
                            <p class="text-gray-500 text-sm mt-1">Monday - Friday: 9:00 AM - 6:00 PM</p>
                            <p class="text-gray-500 text-sm">Saturday: 9:00 AM - 1:00 PM</p>
                            <p class="text-gray-500 text-sm">Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Map Placeholder --}}
            <div class="bg-gray-200 rounded-xl h-48 flex items-center justify-center">
                <div class="text-center text-gray-400">
                    <i class="fas fa-map text-3xl mb-2"></i>
                    <p class="text-sm">Map Location</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
