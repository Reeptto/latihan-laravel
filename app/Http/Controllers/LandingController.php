<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use App\Models\LandingProgram;
use App\Models\LandingNavLink; // Menggunakan model yang benar (bukan LandingNavItem)
use App\Models\LandingFooterLink;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
        // 1. Ambil settings sebagai array key-value (dicache 60 menit)
        $landing = Cache::remember('landing_settings', 60, function () {
            return LandingSetting::pluck('value', 'key')->toArray();
        });

        // 2. Ambil data Programs
        $programs = Cache::remember('landing_programs', 60, function () {
            return LandingProgram::where('status', 1)
                ->orderBy('position')
                ->get();
        });

        // 3. Ambil data Navigasi (Menu Atas)
        $navigation = Cache::remember('landing_nav', 60, function () {
            return LandingNavLink::where('status', 1)
                ->orderBy('position')
                ->get();
        });

        // 4. Ambil data Footer Link
        $footer = Cache::remember('landing_footer', 60, function () {
            return LandingFooterLink::where('status', 1)
                ->orderBy('position')
                ->get();
        });

        // Kirim semua data ke view 'welcome'
        return view('welcome', compact('landing', 'programs', 'navigation', 'footer'));
    }
}