<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use Illuminate\Http\Request;

class LandingSettingController extends Controller
{
    public function index()
    {
        // Mengambil semua setting
        $settings = LandingSetting::all();
        return view('admin.landing.settings.index', compact('settings'));
    }

    public function edit($id)
    {
        $setting = LandingSetting::findOrFail($id);
        return view('admin.landing.settings.edit', compact('setting'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string',
            'type' => 'required|string',
            'value' => 'nullable',
            'status' => 'reqired|boolean',
        ]);

        $value = $request->file('value')->store('landing', 'public');

        if ($request->type === 'image' && $request->hasFile('value')) {
            $value = $request->file('value')->store('landing', 'public');
        }

        LandingSetting::create([
            'key' => $request->key,
            'value' => $value,
            'type' => $request->type,
            'status' => $request->status
        ]);

        return redirect()->route('admin.landing.settings.index')
        ->with('success', 'Setting created successfully');
    }

    public function update(Request $request, $id)
    {
        $setting = LandingSetting::findOrFail($id);

        if ($setting->type === 'image') {
            $request->validate([
                'value' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            ]);

            if ($request->hasFile('value')) {
                // Simpan gambar ke folder public/uploads/landing
                $path = $request->file('value')->store('landing', 'public');
                $setting->value = $path;
            }
        } else {
            $request->validate([
                'value' => 'required',
            ]);
            $setting->value = $request->value;
        }

        $setting->save();

        return redirect()->route('admin.landing.settings.index')
            ->with('success', 'Setting updated successfully');
    }
}