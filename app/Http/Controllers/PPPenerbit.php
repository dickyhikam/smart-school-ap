<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPPenerbit extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Penerbit';
        $data['con_menu'] = 'Perpustakaan';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/penerbit', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['list_data'] = $response['data']['items']; // Mengambil data siswa
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

        return view('library.data_master.penerbit.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Penerbit';
        $data['nama_menu'] = $menu;
        $data['nama_menu2'] = 'Form ' . $menu;
        $data['con_menu'] = 'Perpustakaan';

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            // URL API dengan parameter halaman
            $apiUrl = env('API_URL'); // URL API Anda
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/perpustakaan/penerbit/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array

            $data['nama_menu2'] = 'Form Edit ' . $menu;

            $data['data_row'] = $response['data'];
            $data['action'] = route('actionAddPerpusPenerbit', $id); // Arahkan ke update
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddPerpusPenerbit'); // Arahkan ke store
        }

        return view('library.data_master.penerbit.form', $data);
    }

    public function store(Request $request, $id = null)
    {
        // Prepare data for sending to the API
        $data = [
            'nama' => $request->nama, // Menu name
        ];

        // Define the API URL for store or update
        $apiUrl = env('API_URL') . '/api/perpustakaan/penerbit' . ($id ? "/{$id}" : '');

        // Determine HTTP method (POST for store, PUT for update)
        $method = $id ? 'put' : 'post';

        // Send data to the external API
        $response = Http::withToken(session('token'))
            ->$method($apiUrl, $data);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            $message = $id ? 'Penerbit buku berhasil diperbarui!' : 'Penerbit buku berhasil disimpan!';
            return redirect()->route('pagePerpusPenerbit')->with(['alert-type' => 'success', 'message' => $message]);
        }

        // If there was an error, capture the error message
        $errorMessage = json_decode($response->body(), true);  // Capture the error message from the response body

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }


    public function destroy($id)
    {
        // API URL to delete the menu by its ID
        $apiUrl = env('API_URL') . '/api/perpustakaan/penerbit/' . $id;

        // Send DELETE request to the API
        $response = Http::withToken(session('token'))->delete($apiUrl);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pagePerpusPenerbit')->with(['alert-type' => 'success', 'message' => 'Penerbit buku berhasil dihapus!']);
        }

        // If there was an error, capture the error message
        $errorMessage = json_decode($response->body(), true);  // Capture the error message from the response body
        // dd($response->body());

        // If the request failed, redirect back with error message
        return back()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }
}
