<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrtuController;
use App\Http\Controllers\PPAnggota;
use App\Http\Controllers\PPBuku;
use App\Http\Controllers\PPCatalog;
use App\Http\Controllers\PPDashboard;
use App\Http\Controllers\PPKategori;
use App\Http\Controllers\PPPeminjaman;
use App\Http\Controllers\PPPenerbit;
use App\Http\Controllers\PPPengarang;
use App\Http\Controllers\PPPengembalian;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');
Route::get('/perpustakaan/catalog', [PPCatalog::class, 'index'])->name('pageCatalog');

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
    Route::get('/perpustakaan', [PPDashboard::class, 'index'])->name('pagePerpusDashboard');

    Route::get('/perpustakaan/kategori', [PPKategori::class, 'index'])->name('pagePerpusKategori');
    Route::get('/perpustakaan/kategori/tambah', [PPKategori::class, 'index_form'])->name('pageFormPerpusKategori');
    Route::get('/perpustakaan/kategori/edit/{id?}', [PPKategori::class, 'index_form'])->name('pageFormEditPerpusKategori');
    Route::post('/perpustakaan/kategori/tambah/{id?}', [PPKategori::class, 'store'])->name('actionAddPerpusKategori');
    Route::delete('/perpustakaan/kategori/hapus/{id?}', [PPKategori::class, 'destroy'])->name('actionDeletePerpusKategori');

    Route::get('/perpustakaan/pengarang', [PPPengarang::class, 'index'])->name('pagePerpusPengarang');
    Route::get('/perpustakaan/pengarang/tambah', [PPPengarang::class, 'index_form'])->name('pageFormPerpusPengarang');
    Route::get('/perpustakaan/pengarang/edit/{id?}', [PPPengarang::class, 'index_form'])->name('pageFormEditPerpusPengarang');
    Route::post('/perpustakaan/pengarang/tambah/{id?}', [PPPengarang::class, 'store'])->name('actionAddPerpusPengarang');
    Route::delete('/perpustakaan/pengarang/hapus/{id?}', [PPPengarang::class, 'destroy'])->name('actionDeletePerpusPengarang');

    Route::get('/perpustakaan/penerbit', [PPPenerbit::class, 'index'])->name('pagePerpusPenerbit');
    Route::get('/perpustakaan/penerbit/tambah', [PPPenerbit::class, 'index_form'])->name('pageFormPerpusPenerbit');
    Route::get('/perpustakaan/penerbit/edit/{id?}', [PPPenerbit::class, 'index_form'])->name('pageFormEditPerpusPenerbit');
    Route::post('/perpustakaan/penerbit/tambah/{id?}', [PPPenerbit::class, 'store'])->name('actionAddPerpusPenerbit');
    Route::delete('/perpustakaan/penerbit/hapus/{id?}', [PPPenerbit::class, 'destroy'])->name('actionDeletePerpusPenerbit');

    Route::get('/perpustakaan/buku', [PPBuku::class, 'index'])->name('pagePerpusBuku');
    Route::get('/perpustakaan/buku/tambah', [PPBuku::class, 'index_form'])->name('pageFormPerpusBuku');
    Route::get('/perpustakaan/buku/edit/{id?}', [PPBuku::class, 'index_form'])->name('pageFormEditPerpusBuku');
    Route::post('/perpustakaan/buku/tambah', [PPBuku::class, 'store'])->name('actionAddPerpusBuku');
    Route::delete('/perpustakaan/buku/hapus/{id?}', [PPBuku::class, 'destroy'])->name('actionDeletePerpusBuku');

    Route::get('/perpustakaan/anggota', [PPAnggota::class, 'index'])->name('pagePerpusAnggota');
    Route::post('/perpustakaan/anggota', [PPAnggota::class, 'gabung'])->name('actionGabungPerpusAnggota');

    Route::get('/perpustakaan/peminjaman', [PPPeminjaman::class, 'index'])->name('pagePerpusPeminjaman');
    Route::get('/perpustakaan/peminjaman/detil/{id?}', [PPPeminjaman::class, 'index_detil'])->name('pageDetilPerpusPeminjaman');
    Route::get('/perpustakaan/peminjaman/tambah', [PPPeminjaman::class, 'index_form'])->name('pageFormPerpusPeminjaman');
    Route::post('/perpustakaan/peminjaman/tambah', [PPPeminjaman::class, 'store'])->name('actionAddPerpusPeminjaman');
    Route::post('/perpustakaan/peminjaman/kembali/{id?}', [PPPeminjaman::class, 'storeReturn'])->name('actionReturnPerpusPeminjaman');

    Route::get('/perpustakaan/pengembalian', [PPPengembalian::class, 'index'])->name('pagePerpusPengembalian');

    Route::get('/kelas', [KelasController::class, 'index'])->name('pageKelas');
    Route::get('/kelas/tambah', [KelasController::class, 'index_form'])->name('pageFormKelas');
    Route::get('/kelas/edit/{id?}', [KelasController::class, 'index_form'])->name('pageFormEditKelas');
    Route::post('/kelas/tambah', [KelasController::class, 'store'])->name('actionAddKelas');
    Route::put('/kelas/edit/{id?}', [KelasController::class, 'store_update'])->name('actionEditKelas');
    Route::delete('/kelas/hapus/{id?}', [KelasController::class, 'destroy'])->name('actionDeleteKelas');
});
