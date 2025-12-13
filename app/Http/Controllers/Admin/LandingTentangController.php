<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingTentang;
use Illuminate\Http\Request;

class LandingTentangController extends Controller
{
    public function index()
    {
        $tentang = LandingTentang::orderBy('key')->get();
        return view('admin.landing.tentang.index', compact('tentang'));
    }

    public function edit($id)
    {
        $tentang = LandingTentang::findOrFail($id);
        return view('admin.landing.tentang.edit', compact('tentang'));
    }

    public function update(Request $request, $id)
    {
        $tentang = LandingTentang::findOrFail($id);

        if ($tentang->type === 'image') {
            $request->validate(['value' => 'image|mimes:jpg,png,webp,svg|max:2048']);
            $path = $request->file('value')->store('landing', 'public');
            $tentang->value = $path;
        } else {
            $request->validate(['value' => 'required']);
            $tentang->value = $request->value;
        }

        $tentang->save();
        return redirect()->route('admin.landing.tentang.index')->with('success', 'tentang updated successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'key'    => 'required|string',
            'type'   => 'required|string',
            'value'  => 'nullable',
            'status' => 'required|boolean'
        ]);


        $value = $request->value;

        // Jika type = image, handle upload
        if ($request->type === 'image' && $request->hasFile('value')) {
            $value = $request->file('value')->store('landing', 'public');
        }

        LandingTentang::create([
            'key'    => $request->key,
            'value'  => $value,
            'type'   => $request->type,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.landing.tentang.index')
            ->with('success', 'tentang created successfully');
    }

}