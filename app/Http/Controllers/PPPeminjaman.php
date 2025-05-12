<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPPeminjaman extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Peminjaman';
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
        // Filter data berdasarkan status
        $statusFilter = 'diambil'; // Ganti dengan status yang diinginkan, misalnya 'dikembalikan'
        $filteredItems = array_filter($response['data']['items'], function ($item) use ($statusFilter) {
            return $item['status'] === $statusFilter;
        });

        $data['list_data'] = $filteredItems; // Mengambil data yang sudah difilter
        // Update pagination berdasarkan data yang sudah difilter
        $filteredTotal = count($filteredItems); // Total data yang sudah difilter
        $perPage = $response['data']['per_page']; // Ambil per_page dari response

        // Menghitung total halaman baru berdasarkan data yang sudah difilter
        $totalPages = ceil($filteredTotal / $perPage);
        $currentPage = $response['data']['current_page']; // Halaman saat ini dari response
        $from = ($currentPage - 1) * $perPage + 1;
        $to = min($currentPage * $perPage, $filteredTotal);

        // Membuat pagination baru
        $data['pagination'] = [
            'from' => $from,
            'to' => $to,
            'current_page' => $currentPage,
            'last_page' => $totalPages,
            'total' => $filteredTotal,
            'per_page' => $perPage,
            'next_page_url' => ($currentPage < $totalPages) ? $response['data']['next_page_url'] : null,
            'prev_page_url' => ($currentPage > 1) ? $response['data']['prev_page_url'] : null,
        ];

        return view('library.peminjaman.index', $data);
    }

    public function index_form()
    {
        $menu = 'Peminjaman';
        $data['nama_menu'] = $menu;
        $data['nama_menu2'] = 'Form ' . $menu;
        $data['con_menu'] = 'Perpustakaan';
        $data['action'] = route('actionAddPerpusPeminjaman'); // Arahkan ke store
        $data['apiUrl'] = env('API_URL'); // URL API Anda
        $data['apiToken'] = session('token');

        //ambil dari sesion
        $data['user'] = session('user');
        $data['tgl_pinjam'] = date('d-m-Y', strtotime('now'));
        $data['tgl_kembali'] = date('d-m-Y', strtotime('+7 days'));
        $data['tgl_akhir'] = date('d-m-Y', strtotime('+2 days'));

        return view('library.peminjaman.form', $data);
    }

    public function index_detil($id = null)
    {
        $menu = 'Detil Peminjaman';
        $data['nama_menu'] = $menu;
        $data['nama_menu2'] = 'Data ' . $menu;
        $data['con_menu'] = 'Perpustakaan';

        // Fetch data for the given ID using an API if available
        if (!$id) {
            // Handle errors if the API request fails
            return redirect()->route('pagePerpusPeminjaman')->with(['alert-type' => 'error', 'message' => 'Data not found']);
        }

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))->get($apiUrl . '/api/perpustakaan/peminjaman/' . $id);
        $response = json_decode($response->body(), true); // Dekode response menjadi array
        $data['data_peminjaman'] = $response['data'];
        // dd($data['data_peminjaman']);

        // Pass the data to the view
        return view('library.peminjaman.detil', $data);
    }

    public function store(Request $request)
    {
        //get last date
        $lastDate = date('Y-m-d', strtotime('+2 days'));
        $id_buku_array = explode(',', $request->id_buku);

        // Prepare data for sending to the API
        $data = [
            'metode' => 'langsung',
            'peminjam_id' => $request->id_anggota,
            'tanggal_berakhir' => $lastDate,
            'buku_item_id' => $id_buku_array,
        ];

        // Send data to the external API
        $apiUrl = env('API_URL') . '/api/perpustakaan/peminjaman'; // External API URL for the menu
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pagePerpusPeminjaman')->with(['alert-type' => 'success', 'message' => 'Data peminjaman berhasil disimpan!']);
        }

        // If there was an error, capture the error message
        $errorMessage = json_decode($response->body(), true);  // Capture the error message from the response body

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }

    public function storeReturn($id)
    {
        // Send data to the external API
        $apiUrl = env('API_URL') . '/api/perpustakaan/peminjaman/return/' . $id; // External API URL for the menu
        $response = Http::withToken(session('token'))
            ->post($apiUrl);

        // If there was an error, capture the error message
        $errorMessage = json_decode($response->body(), true);  // Capture the error message from the response body

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pagePerpusPeminjaman')->with(['alert-type' => 'success', 'message' => $errorMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }
}
