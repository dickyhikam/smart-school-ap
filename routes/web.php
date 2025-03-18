<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\SiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('pageDashboard');
Route::get('/guru', [GuruController::class, 'index'])->name('pageGuru');
Route::get('/siswa', [SiswaController::class, 'index'])->name('pageSiswa');
Route::get('/orang-tua', [OrtuController::class, 'index'])->name('pageOrtu');
