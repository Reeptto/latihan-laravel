<?php
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatkulController;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello', function () {
    return "Hello world!!";
});

Route::get('/nama', function () {
    return "Nama saya Ari aprianto kelas ASE10 Jurusan Application software engineering angkatan 10";
});

// Mahasiswa
Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);

// Kelas
Route::get('/kelas', [KelasController::class, 'index']);
Route::post('/kelas', [KelasController::class, 'store']);

// Matkul
Route::get('/matkul', [MatkulController::class, 'index']);
Route::post('/matkul', [MatkulController::class, 'store']);