<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthPegawaiController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\OrganisasiController;
use App\Http\Controllers\MerchandiseController;
use App\Http\Controllers\PenitipController;

// Route AUTH
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthPegawaiController::class, 'login']);
    Route::post('register', [AuthPegawaiController::class, 'register']);

    Route::middleware('auth:api')->group(function () {
        Route::post('/logout', [AuthPegawaiController::class, 'logout']);
        Route::get('/profile', [AuthPegawaiController::class, 'profile']);
    });
});

// Route ADMIN Only
Route::prefix('admin')->middleware(['jwt.auth', 'role:admin'])->group(function () {
    Route::apiResource('manage-pegawai', PegawaiController::class);
    Route::apiResource('manage-jabatan', JabatanController::class);
    Route::apiResource('manage-organisasi', OrganisasiController::class);
    Route::apiResource('manage-merchandise', MerchandiseController::class);
});

// Route CS Only
Route::prefix('cs')->middleware(['jwt.auth', 'role:cs'])->group(function () {
    Route::apiResource('manage-penitip', PenitipController::class);
});
