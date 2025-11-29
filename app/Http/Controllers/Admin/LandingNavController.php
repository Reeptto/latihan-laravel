<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingNavLink; 
use Illuminate\Http\Request;

class LandingNavController extends Controller
{
    public function index()
    {
        $items = LandingNavLink::orderBy('order')->get();
        return view('admin.landing.nav.index', compact('items'));
    }

    public function create()
    {
        return view('admin.landing.nav.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:100',
            'url' => 'required|string',
            'order' => 'required|integer',
        ]);

        LandingNavLink::create($request->all());

        return redirect()->route('admin.landing.navigation.index')
            ->with('success', 'Menu created successfully');
    }

    public function edit($id)
    {
        $item = LandingNavLink::findOrFail($id);
        return view('admin.landing.nav.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = LandingNavLink::findOrFail($id);
        $item->update($request->all());

        return redirect()->route('admin.landing.navigation.index')
            ->with('success', 'Menu updated successfully');
    }

    public function destroy($id)
    {
        $item = LandingNavLink::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Menu deleted successfully');
    }
}