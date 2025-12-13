<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LandingSetting;
use App\Models\LandingProgram;
use App\Models\LandingNavLink; 
use App\Models\LandingFooterLink;
use App\Models\LandingTentang;
use Illuminate\Support\Facades\Cache;

class LandingController extends Controller
{
    public function index()
    {
       
        $landing = Cache::remember('landing_settings', 60, function () {
            return LandingSetting::pluck('value', 'key')->toArray();
        });

   
        $programs = Cache::remember('landing_programs', 60, function () {
            return LandingProgram::where('status', 1)
                ->orderBy('position')
                ->get();
        });


        $navigation = Cache::remember('landing_nav', 60, function () {
            return LandingNavLink::where('status', 1)
                ->orderBy('position')
                ->get();
        });

        $tentang = Cache::remember('landing_tentang', 60, function () {
            return LandingTentang::pluck('value', 'key')->toArray();
        });

        $footer = Cache::remember('landing_footer', 60, function () {
            return LandingFooterLink::where('status', 1)
                ->orderBy('position')
                ->get();
        });

        // Kirim semua data ke view 'welcome'
        return view('welcome', compact('landing', 'programs', 'navigation', 'footer', 'tentang'));
    }
}