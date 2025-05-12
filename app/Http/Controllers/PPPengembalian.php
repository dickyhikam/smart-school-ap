<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPPengembalian extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Pengembalian';
        $data['con_menu'] = 'Perpustakaan';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/peminjaman', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array
        // Filter data berdasarkan status
        $statusFilter = 'diambil'; // Ganti dengan status yang diinginkan, misalnya 'dikembalikan'
        $filteredItems = array_filter($response['data']['items'], function ($item) use ($statusFilter) {
            return $item['status'] !== $statusFilter;
        });

        $data['list_data'] = $filteredItems; // Mengambil data yang sudah difilter
        // Mengambil data pagination
        $data['pagination'] = [
            'from' => $response['data']['from'],
            'to' => $response['data']['to'],
            'current_page' => $response['data']['current_page'],
            'last_page' => $response['data']['last_page'],
            'total' => $response['data']['total'],
            'per_page' => $response['data']['per_page'],
            'next_page_url' => $response['data']['next_page_url'],
            'prev_page_url' => $response['data']['prev_page_url'],
        ];

        return view('library.pengembalian.index', $data);
    }

    public function index_form()
    {
        $menu = 'Pengembalian';
        $data['nama_menu'] = $menu;
        $data['nama_menu2'] = 'Form ' . $menu;
        $data['con_menu'] = 'Perpustakaan';
        $data['action'] = route('actionAddPerpusPengembalian'); // Arahkan ke store

        return view('library.pengembalian.form', $data);
    }
}
