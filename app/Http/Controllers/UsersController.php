<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Auth User';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/users', [
                'page' => $page,
                'per_page' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        // dd($response['data']['items']);

        $data['list_data'] = $response['data']['items']; // Mengambil data user
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

        return view('user.index', $data);
    }

    public function update_status(Request $request)
    {
        // Persiapkan data untuk dikirim ke API
        $data = [
            'is_active' => ($request->is_active === 'Aktif') ? true : false,
        ];

        // Kirim data ke API
        $apiUrl = env('API_URL') . '/api/users/toggle-active/' . $request->id; // URL API eksternal Anda
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);

        // Cek jika berhasil
        if ($response->successful()) {
            return redirect()->route('pageUser')->with(['alert-type' => 'success', 'message' => 'Status user berhasil diubah']);
        }

        // Cek alasan kegagalan
        $errorMessage = json_decode($response->body(), true);  // Mengambil pesan error dari response body

        // Jika gagal menyimpan data siswa
        return back()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }
}
