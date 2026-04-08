@extends('layouts.app')

@section('title', 'Register - Mars Stationery')

@section('content')

<div class="bg-light min-h-[60vh] flex items-center justify-center py-12">
    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="text-4xl font-heading font-extrabold text-primary tracking-wider">MARS</a>
            <p class="text-gray-500 text-sm mt-2">Create your free account</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ url('/register') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name *</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" name="phone" value="{{ old('phone') }}"
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password *</label>
                    <input type="password" name="password" required
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                    Create Account
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-400">or register with</span></div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <button type="button" class="flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <i class="fab fa-google text-red-500"></i> Google
                </button>
                <button type="button" class="flex items-center justify-center gap-2 border border-gray-200 rounded-lg py-2.5 text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                    <i class="fab fa-facebook text-blue-600"></i> Facebook
                </button>
            </div>

            <p class="text-center text-sm text-gray-500 mt-6">
                Already have an account? <a href="{{ url('/login') }}" class="text-primary font-medium hover:underline">Sign In</a>
            </p>
        </div>
    </div>
</div>

@endsection
