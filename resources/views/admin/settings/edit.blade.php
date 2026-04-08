@extends('admin.layouts.app')
@section('title', 'Site Settings')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Site Settings</h2>

            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                @method('PUT')

                <div class="space-y-8">
                    {{-- General --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">General</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Name</label>
                                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label for="site_tagline" class="block text-sm font-medium text-gray-700 mb-1">Site Tagline</label>
                                <input type="text" name="site_tagline" id="site_tagline" value="{{ old('site_tagline', $settings['site_tagline']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="site_email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="site_email" id="site_email" value="{{ old('site_email', $settings['site_email']) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                                <div>
                                    <label for="site_phone" class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                                    <input type="text" name="site_phone" id="site_phone" value="{{ old('site_phone', $settings['site_phone']) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                            </div>
                            <div>
                                <label for="site_address" class="block text-sm font-medium text-gray-700 mb-1">Address</label>
                                <textarea name="site_address" id="site_address" rows="2"
                                          class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ old('site_address', $settings['site_address']) }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Social Media --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">Social Media</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="facebook_url" class="block text-sm font-medium text-gray-700 mb-1">Facebook URL</label>
                                <input type="url" name="facebook_url" id="facebook_url" value="{{ old('facebook_url', $settings['facebook_url']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="https://facebook.com/...">
                            </div>
                            <div>
                                <label for="instagram_url" class="block text-sm font-medium text-gray-700 mb-1">Instagram URL</label>
                                <input type="url" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $settings['instagram_url']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="https://instagram.com/...">
                            </div>
                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-1">Twitter URL</label>
                                <input type="url" name="twitter_url" id="twitter_url" value="{{ old('twitter_url', $settings['twitter_url']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="https://twitter.com/...">
                            </div>
                        </div>
                    </div>

                    {{-- Bank Details --}}
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">Bank Details</h3>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-1">Bank Name</label>
                                    <input type="text" name="bank_name" id="bank_name" value="{{ old('bank_name', $settings['bank_name']) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                                <div>
                                    <label for="bank_branch" class="block text-sm font-medium text-gray-700 mb-1">Branch</label>
                                    <input type="text" name="bank_branch" id="bank_branch" value="{{ old('bank_branch', $settings['bank_branch']) }}"
                                           class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                </div>
                            </div>
                            <div>
                                <label for="bank_account_name" class="block text-sm font-medium text-gray-700 mb-1">Account Name</label>
                                <input type="text" name="bank_account_name" id="bank_account_name" value="{{ old('bank_account_name', $settings['bank_account_name']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                            <div>
                                <label for="bank_account_number" class="block text-sm font-medium text-gray-700 mb-1">Account Number</label>
                                <input type="text" name="bank_account_number" id="bank_account_number" value="{{ old('bank_account_number', $settings['bank_account_number']) }}"
                                       class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-red-500 focus:border-red-500">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8">
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg text-sm font-medium transition-colors">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection
