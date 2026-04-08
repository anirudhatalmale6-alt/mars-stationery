<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class AdminSettingsController extends Controller
{
    private array $settingKeys = [
        'site_name',
        'site_tagline',
        'site_email',
        'site_phone',
        'site_address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'bank_name',
        'bank_account_name',
        'bank_account_number',
        'bank_branch',
    ];

    public function edit()
    {
        $settings = [];
        foreach ($this->settingKeys as $key) {
            $setting = SiteSetting::where('key', $key)->first();
            $settings[$key] = $setting ? $setting->value : '';
        }
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($this->settingKeys as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($key, '')]
            );
        }

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
