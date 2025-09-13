<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index() 
    {
        $data = Kelas::all();
        return view('kelas.index', compact('data'));
    }

    public function store(Request $request) 
    {
        Kelas::create($request->only('nama', 'kapastas'));
        return redirect()->back();
    }
}
