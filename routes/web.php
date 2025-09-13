<?php
use App\Http\Controllers\MahasiswaController;
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

Route::get('/mahasiswa', [MahasiswaController::class, 'index']);
Route::post('/mahasiswa', [MahasiswaController::class, 'store']);