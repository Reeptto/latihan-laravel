<?php

namespace App\Http\Controllers;

use illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Redirect;

class MahasiswaController extends Controller
{
    public function index() 
    {
        $data = Mahasiswa::all();
        return view('mahasiswa.index', compact('data'));
    }

    public function store(Request $request) 
    {
        Mahasiswa::create($request->only('nama','nim'));
        return Redirect()->back();
    }
}
