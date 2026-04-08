@extends('admin.layouts.app')
@section('title', 'Delivery Settings')

@section('content')
    <div class="max-w-lg">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Delivery Charges</h2>

            <form method="POST" action="{{ route('admin.delivery.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-5">
                    <div>
                        <label for="first_kg_charge" class="block text-sm font-medium text-gray-700 mb-1">First KG Charge (LKR)</label>
                        <input type="number" name="first_kg_charge" id="first_kg_charge" value="{{ old('first_kg_charge', $delivery->first_kg_charge) }}" step="0.01" min="0" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <p class="text-xs text-gray-400 mt-1">Charge for the first kilogram of total order weight</p>
                        @error('first_kg_charge') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="additional_kg_charge" class="block text-sm font-medium text-gray-700 mb-1">Additional KG Charge (LKR)</label>
                        <input type="number" name="additional_kg_charge" id="additional_kg_charge" value="{{ old('additional_kg_charge', $delivery->additional_kg_charge) }}" step="0.01" min="0" required
                               class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <p class="text-xs text-gray-400 mt-1">Charge for each additional kilogram beyond the first</p>
                        @error('additional_kg_charge') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
