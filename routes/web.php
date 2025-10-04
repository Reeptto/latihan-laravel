<?php
use App\Http\Controllers\DosenController;
// use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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


   
});

require __DIR__.'/auth.php';
