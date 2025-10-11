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

    public function step2()
    {
        $data = EkycRegistration::where('user_id', Auth::id())->first();
        return view('ekyc.step2', compact('data'));
    }

    public function storeStep2(Request $request)
    {
        $validated = $request->validate([
            'file_ktp' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_selfie' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $ekyc = EkycRegistration::firstOrCreate(['user_id' => Auth::id()]);

        if ($request->hasFile('file_ktp')) {
            $validated['file_ktp'] = $request->file('file_ktp')->store('ekyc', 'public');
        }

        if ($request->hasFile('file_selfie')) {
            $validated['file_selfie'] = $request->file('file_selfie')->store('ekyc', 'public');
        }

        $ekyc->update($validated);

        return back()->with('success', 'Data tersimpan');
    }

    public function showStep3 ()
    {
        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();
        return view('ekyc.step3', compact('data'));
    }

    public function storeStep3(Request $request)
    {
        $request->validate([
            'asal_sd' => 'nullable|string|max:255',
            'asal_smp' => 'nullable|string|max:255',
            'asal_sma' => 'nullable|string|max:255',
            'file_kkk' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_ijazah' => 'nullable|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = \App\Models\EkycRegistration::where('user_id', auth()->id())->first();
        
        $data->asal_sd =$request->asal_sd;
        $data->asal_smp =$request->asal_smp;
        $data->asal_sma =$request->asal_sma;

        if ($request->hasFile('file_kkk')) {
            $data->file_kkk = $request->file('file_kkk')->store('ekyc', 'public');
        }
        if ($request->hasFile('file_ijazah')) {
            $data->file_kkk = $request->file('file_ijazah')->store('ekyc', 'public');
        }

        $data->save();

        return redirect()->route('ekyc.step3')->with('success', 'Data pendidikan berhasil disimpan');
    }
}
 