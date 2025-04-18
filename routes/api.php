<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PembelajaranController;
use Illuminate\Http\Request;


// Registrasi API
Route::post('/auth/register', [AuthController::class, 'apiRegister'])->name('api.register');

// Login API
Route::post('/auth/login', [AuthController::class, 'apiLogin'])->name('api.login');

// Logout API (Perlu autentikasi menggunakan Sanctum)
Route::middleware('auth:sanctum')->post('/auth/logout', [AuthController::class, 'apiLogout'])->name('api.logout');

// Mengambil data user yang sudah login
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json($request->user());
});

// Pembelajaran API yang hanya dapat diakses dengan autentikasi
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/pembelajaran', [PembelajaranController::class, 'apiIndex']);
});


