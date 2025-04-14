<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPBuku extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Buku';
        $data['con_menu'] = 'Perpustakaan';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/buku', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['list_data'] = $response['data']['items']; // Mengambil data siswa
        // Mengambil data pagination
        $data['pagination'] = [
            'current_page' => $response['data']['current_page'],
            'last_page' => $response['data']['last_page'],
            'total' => $response['data']['total'],
            'per_page' => $response['data']['per_page'],
            'next_page_url' => $response['data']['next_page_url'],
            'prev_page_url' => $response['data']['prev_page_url'],
        ];

        return view('library.data_master.buku.index', $data);
    }

    public function index_form($id = null)
    {
        $data['nama_menu'] = 'Buku';
        $data['nama_menu2'] = 'Form Buku';
        $data['con_menu'] = 'Perpustakaan';
        // Jika tidak ada $id, berarti ini adalah halaman Create
        $data['action'] = route('actionAddGuru'); // Arahkan ke store
        $data['method'] = 'POST'; // Menggunakan metode POST untuk create

        return view('library.data_master.buku.form', $data);
    }
}
