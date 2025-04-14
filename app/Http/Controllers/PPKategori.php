<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPKategori extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Kategori';
        $data['con_menu'] = 'Perpustakaan';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        // $response = Http::withToken(session('token'))
        //     ->get($apiUrl . '/api/perpustakaan/buku', [
        //         'page' => $page,
        //         'perPage' => $perPage, // Kirim parameter per_page
        //         'search' => $search, // Kirim parameter pencarian
        //     ]);
        // $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['list_data'] = []; // Mengambil data siswa
        // Mengambil data pagination
        $data['pagination'] = [
            'current_page' => 0,
            'last_page' => 0,
            'total' => 0,
            'per_page' => 0,
            'next_page_url' => null,
            'prev_page_url' => null,
        ];

        return view('library.data_master.kategori.index', $data);
    }

    public function index_form($id = null)
    {
        $data['nama_menu'] = 'Kategori';
        $data['nama_menu2'] = 'Form Kategori';
        $data['con_menu'] = 'Perpustakaan';
        // Jika tidak ada $id, berarti ini adalah halaman Create
        $data['action'] = route('actionAddGuru'); // Arahkan ke store
        $data['method'] = 'POST'; // Menggunakan metode POST untuk create

        return view('library.data_master.kategori.form', $data);
    }
}
