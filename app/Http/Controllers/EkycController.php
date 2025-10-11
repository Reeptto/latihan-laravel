<?php

namespace App\Http\Controllers;

use App\Models\EkycRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EkycController extends Controller
{
    public function step1()
    {
        $ekyc = EkycRegistration::where('user_id', Auth::id())
                ->where('status', 'draft')
                ->first();

        if ($ekyc) {
            session(['ekyc_id'=> $ekyc->id]);
        }

        return view('ekyc.step1', compact('ekyc'));
    }

    public function storeStep1(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'nik' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string'
        ]);

        $ekyc = EkycRegistration::UpdateOrCreate(
            [
                'id' => session('ekyc.id'),
                'user_id' => Auth::id()
            ],
            [
                'nama' => $request->nama,
                'nik' => $request->nik,
                'tanggal_lahir' => $request->tanggal_lahir,
                'alamat' => $request->alamat,
                'status' => 'draft',
            ]
        );

        session(['ekyc_id' => $ekyc->id]);

        return redirect()->route('ekyc.step2')->with('success', 'Data pribadi disimpan, lanjut ke langkah berikutnya,');
    }
}
 