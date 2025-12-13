<?php
use App\Http\Controllers\Admin\LandingTentangController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\StudentRegisterController;
use App\Http\Controllers\EkycController;
use App\Http\Controllers\Admin\EkycAdminController;
use App\Http\Controllers\LandingController;

use App\Http\Controllers\Admin\LandingSettingController;
use App\Http\Controllers\Admin\LandingNavController;
use App\Http\Controllers\Admin\LandingProgramController;
use App\Http\Controllers\Admin\LandingFooterController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class,'index'])->name('mahasiswa.index');
    Route::post('/mahasiswa', [MahasiswaController::class,'store'])->name('mahasiswa.store');
    Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
    Route::put('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
    Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');



    // Ruangan
    Route::get('/kelas', [KelasController::class,'index'])->name('kelas.index');
    Route::post('/kelas', [KelasController::class,'store'])->name('kelas.store');

    // Dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
    Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');

    // Matkul
    Route::get('/matkul', [MatkulController::class, 'index'])->name('matkul.index');
    Route::post('/matkul', [MatkulController::class, 'store'])->name('matkul.store');

    Route::prefix('admin')->group(function () {
        Route::get('/ekyc', [EkycAdminController::class, 'index'])->name('admin.ekyc.index');
        Route::get('/ekyc/{id}', [EkycAdminController::class, 'show'])->name('admin.ekyc.show');
        Route::post('/ekyc/{id}/verify', [EkycAdminController::class, 'verify'])->name('admin.ekyc.verify');
    });

    /**
     * LANDING PAGE CMS
     */

    Route::prefix('admin/landing')->name('admin.landing.')->group(function () {
        Route::resource('settings', LandingSettingController::class)->only(['index', 'store', 'edit', 'update']);

        Route::resource('tentang', LandingTentangController::class)->only(['index', 'store', 'edit', 'update']);
        
        Route::resource('navigation', LandingNavController::class)->except(['show']);
        Route::resource('programs', LandingProgramController::class)->except(['show']);
        Route::resource('footer', LandingFooterController::class)->except(['show']);
        Route::post('footer/reorder', [LandingFooterController::class, 'reorder'])->name('admin.landing.footer.reorder');
        Route::patch('footer/{id}/status', [LandingFooterController::class, 'toggleStatus'])->name('admin.landing.footer.toggle.status');
    });


    // EKYC
    Route::get('/register-mahasiswa', [StudentRegisterController::class, 'showRegistrationForm'])->name('register.mahasiswa');
    Route::post('/register-mahasiswa', [StudentRegisterController::class, 'register']);

    Route::middleware(['auth'])->prefix('ekyc')->group(function () { 
        // Step 1
        Route::get('step1', [EkycController::class, 'step1'])->name('ekyc.step1');
        Route::post('step1', [EkycController::class, 'storeStep1'])->name('ekyc.storeStep1');

        // Step 2
        Route::get('/ekyc/step2', [EkycController::class, 'step2'])->name('ekyc.step2');
        Route::post('/ekyc/step2', [EkycController::class, 'storeStep2'])->name('ekyc.step2.store');

        // Step 3
        Route::get('/ekyc/step3', [EkycController::class, 'showStep3'])->name('ekyc.step3');
        Route::post('/ekyc/step3', [EkycController::class, 'storeStep3'])->name('ekyc.step3.store');

        // Step 4
        Route::get('/ekyc/step4', [EkycController::class, 'step4'])->name('ekyc.step4');
        Route::post('/ekyc/step4', [EkycController::class, 'storeStep4'])->name('ekyc.step4.store');

        // Ending EKYC
        Route::get('/ekyc/step5', [EkycController::class, 'step5'])->name('ekyc.step5');

        // Rejected EKYC
        Route::get('/rejected', [EkycController::class, 'rejected'])->name('ekyc.rejected');

        // Accepted EKYC
        Route::get('/accepted', [EkycController::class, 'accepted'])->name('ekyc.accepted');

    });
   
});

require __DIR__.'/auth.php';
