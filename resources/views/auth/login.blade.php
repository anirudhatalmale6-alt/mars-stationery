@extends('layouts.app')

@section('title', 'Login - Mars Stationery')

@section('content')

<div class="bg-light min-h-[60vh] flex items-center justify-center py-12">
    <div class="w-full max-w-md px-4">
        <div class="text-center mb-8">
            <a href="{{ url('/') }}" class="text-4xl font-heading font-extrabold text-primary tracking-wider">MARS</a>
            <p class="text-gray-500 text-sm mt-2">Sign in to your account</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                           class="w-full border border-gray-200 rounded-lg px-4 py-2.5 text-sm focus:ring-2 focus:ring-primary focus:border-primary focus:outline-none">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-primary border-gray-300 rounded focus:ring-primary">
                        <span class="text-sm text-gray-600">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-primary hover:bg-red-700 text-white py-3 rounded-lg font-semibold transition">
                    Sign In
                </button>
            </form>

            <div class="relative my-6">
                <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-200"></div></div>
                <div class="relative flex justify-center text-sm"><span class="px-3 bg-white text-gray-400">or continue with</span></div>
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
                Don't have an account? <a href="{{ url('/register') }}" class="text-primary font-medium hover:underline">Register</a>
            </p>
        </div>
    </div>
</div>

@endsection
