@php
    $currentPath = request()->path();
@endphp
<aside class="lg:w-64 flex-shrink-0">
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden">
        <div class="bg-primary p-5 text-white">
            <div class="w-14 h-14 bg-white/20 rounded-full flex items-center justify-center mb-3">
                <i class="fas fa-user text-2xl"></i>
            </div>
            <h3 class="font-heading font-semibold">{{ auth()->user()->name }}</h3>
            <p class="text-red-200 text-xs mt-0.5">{{ auth()->user()->email }}</p>
        </div>
        <nav class="p-2">
            <a href="{{ url('/account') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm {{ $currentPath === 'account' ? 'bg-red-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <i class="fas fa-tachometer-alt w-5 text-center"></i> Dashboard
            </a>
            <a href="{{ url('/account/orders') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm {{ str_starts_with($currentPath, 'account/orders') ? 'bg-red-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <i class="fas fa-box w-5 text-center"></i> My Orders
            </a>
            <a href="{{ url('/account/addresses') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm {{ $currentPath === 'account/addresses' ? 'bg-red-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <i class="fas fa-map-marker-alt w-5 text-center"></i> Addresses
            </a>
            <a href="{{ url('/account/profile') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm {{ $currentPath === 'account/profile' ? 'bg-red-50 text-primary font-semibold' : 'text-gray-600 hover:bg-gray-50' }} transition">
                <i class="fas fa-user-cog w-5 text-center"></i> Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm text-gray-600 hover:bg-gray-50 transition w-full text-left">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i> Logout
                </button>
            </form>
        </nav>
    </div>
</aside>
