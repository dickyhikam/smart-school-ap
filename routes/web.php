<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\PPAnggota;
use App\Http\Controllers\PPBuku;
use App\Http\Controllers\PPDashboard;
use App\Http\Controllers\PPKategori;
use App\Http\Controllers\PPPenerbit;
use App\Http\Controllers\PPPengarang;
use App\Http\Controllers\RoleController;
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
    Route::get('/orang-tua/{id}', [OrtuController::class, 'show_data'])->name('actionShowOrtu');

    Route::get('/auth-user', [UsersController::class, 'index'])->name('pageUser');
    Route::post('/auth-user/status', [UsersController::class, 'update_status'])->name('actionStatusUser');

    Route::get('/role', [RoleController::class, 'index'])->name('pageRole');
    Route::get('/role/tambah', [RoleController::class, 'index_form'])->name('pageFormRole');
    Route::get('/role/edit/{id?}', [RoleController::class, 'index_form'])->name('pageFormEditRole');
    Route::post('/role/tambah', [RoleController::class, 'store'])->name('actionAddRole');
    Route::put('/role/edit/{id?}', [RoleController::class, 'store_update'])->name('actionEditRole');
    Route::delete('/role/hapus/{id?}', [RoleController::class, 'destroy'])->name('actionDeleteRole');

    Route::get('/permission', [RoleController::class, 'index'])->name('pagePermission');
    Route::get('/permission/tambah', [RoleController::class, 'index_form'])->name('pageFormPermission');
    Route::get('/permission/edit/{id?}', [RoleController::class, 'index_form'])->name('pageFormEditPermission');
    Route::post('/permission/tambah', [RoleController::class, 'store'])->name('actionAddPermission');
    Route::put('/permission/edit/{id?}', [RoleController::class, 'store_update'])->name('actionEditPermission');
    Route::delete('/permission/hapus/{id?}', [RoleController::class, 'destroy'])->name('actionDeletePermission');

    Route::get('/menu', [MenuController::class, 'index'])->name('pageMenu');
    Route::get('/menu/tambah', [MenuController::class, 'index_form'])->name('pageFormMenu');
    Route::get('/menu/edit/{id?}', [MenuController::class, 'index_form'])->name('pageFormEditMenu');
    Route::post('/menu/tambah', [MenuController::class, 'store'])->name('actionAddMenu');
    Route::put('/menu/edit/{id?}', [MenuController::class, 'store_update'])->name('actionEditMenu');
    Route::delete('/menu/hapus/{id?}', [MenuController::class, 'destroy'])->name('actionDeleteMenu');

    //bagian perpustakaan
    Route::get('/perpustakaan/dashboard', [PPDashboard::class, 'index'])->name('pagePerpusDashboard');

    Route::get('/perpustakaan/kategori', [PPKategori::class, 'index'])->name('pagePerpusKategori');
    Route::get('/perpustakaan/kategori/tambah', [PPKategori::class, 'index_form'])->name('pagePerpusFormKategori');

    Route::get('/perpustakaan/pengarang', [PPPengarang::class, 'index'])->name('pagePerpusPengarang');
    Route::get('/perpustakaan/pengarang/tambah', [PPPengarang::class, 'index_form'])->name('pagePerpusFormPengarang');

    Route::get('/perpustakaan/penerbit', [PPPenerbit::class, 'index'])->name('pagePerpusPenerbit');
    Route::get('/perpustakaan/penerbit/tambah', [PPPengarang::class, 'index_form'])->name('pagePerpusFormPenerbit');

    Route::get('/perpustakaan/buku', [PPBuku::class, 'index'])->name('pagePerpusBuku');
    Route::get('/perpustakaan/buku/tambah', [PPBuku::class, 'index_form'])->name('pagePerpusFormBuku');

    Route::get('/perpustakaan/anggota', [PPAnggota::class, 'index'])->name('pagePerpusAnggota');
});
