<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeliverySetting;
use Illuminate\Http\Request;

class AdminDeliveryController extends Controller
{
    public function edit()
    {
        $delivery = DeliverySetting::first();
        if (!$delivery) {
            $delivery = DeliverySetting::create([
                'first_kg_charge' => 0,
                'additional_kg_charge' => 0,
                'is_active' => true,
            ]);
        }
        return view('admin.delivery.edit', compact('delivery'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'first_kg_charge' => 'required|numeric|min:0',
            'additional_kg_charge' => 'required|numeric|min:0',
        ]);

        $delivery = DeliverySetting::first();
        $delivery->update($validated);

        return redirect()->route('admin.delivery.edit')->with('success', 'Delivery settings updated successfully.');
    }
}
