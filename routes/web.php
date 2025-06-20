<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasSiswaController;
use App\Http\Controllers\KelasSubController;
use App\Http\Controllers\MapelController;
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
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('actionLogin');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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
    Route::get('/perpustakaan/buku/print/{id}', [PPBuku::class, 'printBuku'])->name('pagePrintPerpusBuku');

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

    Route::get('/jurusan', [JurusanController::class, 'index'])->name('pageJurusan');
    Route::get('/jurusan/tambah', [JurusanController::class, 'index_form'])->name('pageFormJurusan');
    Route::get('/jurusan/edit/{id?}', [JurusanController::class, 'index_form'])->name('pageFormEditJurusan');
    Route::post('/jurusan/tambah', [JurusanController::class, 'store'])->name('actionAddJurusan');
    Route::put('/jurusan/edit/{id?}', [JurusanController::class, 'store_update'])->name('actionEditJurusan');
    Route::delete('/jurusan/hapus/{id?}', [JurusanController::class, 'destroy'])->name('actionDeleteJurusan');

    Route::get('/mata-pelajaran', [MapelController::class, 'index'])->name('pageMapel');
    Route::get('/mata-pelajaran/tambah', [MapelController::class, 'index_form'])->name('pageFormMapel');
    Route::get('/mata-pelajaran/edit/{id?}', [MapelController::class, 'index_form'])->name('pageFormEditMapel');
    Route::post('/mata-pelajaran/tambah', [MapelController::class, 'store'])->name('actionAddMapel');
    Route::put('/mata-pelajaran/edit/{id?}', [MapelController::class, 'store_update'])->name('actionEditMapel');
    Route::delete('/mata-pelajaran/hapus/{id?}', [MapelController::class, 'destroy'])->name('actionDeleteMapel');

    Route::get('/akademik/tambah', [TahunAjaranController::class, 'index_form_akademik'])->name('pageFormAkademik');

    Route::get('/tahun-ajaran', [TahunAjaranController::class, 'index'])->name('pageTahunAjaran');
    Route::get('/tahun-ajaran/tambah', [TahunAjaranController::class, 'index_form'])->name('pageFormTahunAjaran');
    Route::get('/tahun-ajaran/edit/{id?}', [TahunAjaranController::class, 'index_form'])->name('pageFormEditTahunAjaran');
    Route::post('/tahun-ajaran/tambah', [TahunAjaranController::class, 'store'])->name('actionAddTahunAjaran');
    Route::put('/tahun-ajaran/edit-action', [TahunAjaranController::class, 'store_update'])->name('actionEditTahunAjaran');
    Route::delete('/tahun-ajaran/hapus/{id?}', [TahunAjaranController::class, 'destroy'])->name('actionDeleteTahunAjaran');

    Route::get('/sub-kelas', [KelasSubController::class, 'index'])->name('pageKelasSub');
    Route::get('/sub-kelas/tambah/{th?}', [KelasSubController::class, 'index_form'])->name('pageFormKelasSub');
    Route::get('/sub-kelas/edit/{th?}/{id?}', [KelasSubController::class, 'index_form'])->name('pageFormEditKelasSub');
    Route::post('/sub-kelas/tambah', [KelasSubController::class, 'store'])->name('actionAddKelasSub');
    Route::put('/sub-kelas/edit/{id?}', [KelasSubController::class, 'store_update'])->name('actionEditKelasSub');
    Route::delete('/sub-kelas/hapus/{th?}/{id?}', [KelasSubController::class, 'destroy'])->name('actionDeleteKelasSub');

    Route::get('/siswa-kelas', [KelasSiswaController::class, 'index'])->name('pageKelasSiswa');
    Route::get('/siswa-kelas/detil/{id?}', [KelasSiswaController::class, 'index_form'])->name('pageDetilKelasSiswa');
    Route::post('/siswa-kelas/tambah', [KelasSiswaController::class, 'store'])->name('actionAddKelasSiswa');
    Route::put('/siswa-kelas/edit/{id?}', [KelasSiswaController::class, 'store_update'])->name('actionEditKelasSiswa');
    Route::delete('/siswa-kelas/hapus/{th?}/{id?}', [KelasSiswaController::class, 'destroy'])->name('actionDeleteKelasSiswa');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('pageJadwal');
    Route::get('/jadwal/tambah', [JadwalController::class, 'index_form'])->name('pageFormJadwal');
    Route::get('/jadwal/edit/{id?}', [JadwalController::class, 'index_form'])->name('pageFormEditJadwal');
    Route::post('/jadwal/tambah', [JadwalController::class, 'store'])->name('actionAddJadwal');
    Route::put('/jadwal/edit/{id?}', [JadwalController::class, 'store_update'])->name('actionEditJadwal');
    Route::delete('/jadwal/hapus/{id?}', [JadwalController::class, 'destroy'])->name('actionDeleteJadwal');
});
