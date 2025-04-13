<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');

// Protected routes
Route::middleware('APIAuth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pageDashboard');

    Route::get('/guru', [GuruController::class, 'index'])->name('pageGuru');
    Route::get('/guru/tambah', [GuruController::class, 'index_form'])->name('pageFormGuru');
    Route::get('/guru/edit/{id?}', [GuruController::class, 'index_form'])->name('pageFormEditGuru');
    Route::post('/guru/tambah', [GuruController::class, 'store'])->name('actionAddGuru');
    Route::put('/guru/edit/{id?}', [GuruController::class, 'store_update'])->name('actionEditGuru');
    Route::delete('/guru/hapus/{id?}', [GuruController::class, 'destroy'])->name('actionDeleteGuru');

    Route::get('/siswa', [SiswaController::class, 'index'])->name('pageSiswa');
    Route::get('/siswa/tambah', [SiswaController::class, 'index_form'])->name('pageFormSiswa');
    Route::get('/siswa/edit/{id?}', [SiswaController::class, 'index_form'])->name('pageFormEditSiswa');
    Route::post('/siswa/tambah', [SiswaController::class, 'store'])->name('actionAddSiswa');
    Route::put('/siswa/edit/{id?}', [SiswaController::class, 'store_update'])->name('actionEditSiswa');
    Route::delete('/siswa/hapus/{id?}', [SiswaController::class, 'destroy'])->name('actionDeleteSiswa');

    Route::get('/orang-tua', [OrtuController::class, 'index'])->name('pageOrtu');

    Route::get('/auth-user', [UsersController::class, 'index'])->name('pageUser');
});
