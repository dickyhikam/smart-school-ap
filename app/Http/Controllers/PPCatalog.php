<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPCatalog extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Catalog';
        $data['apiUrl'] = env('API_URL'); // URL API Anda
        $data['apiToken'] = session('token');

        //get data category
        $apiUrl = env('API_URL'); // URL API Anda
        $response_category = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/kategori-buku');
        $response_category = json_decode($response_category->body(), true); // Dekode response menjadi array
        $data['list_category'] = $response_category['data']['items'];

        //get data penerbit
        $response_penerbit = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/penerbit');
        $response_penerbit = json_decode($response_penerbit->body(), true); // Dekode response menjadi array
        $data['list_penerbit'] = $response_penerbit['data']['items'];

        //get data pengarang
        $response_pengarang = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/pengarang');
        $response_pengarang = json_decode($response_pengarang->body(), true); // Dekode response menjadi array
        $data['list_pengarang'] = $response_pengarang['data']['items'];

        // $data['list_penerbit'] = [];
        // $data['list_category'] = [];
        // $data['list_pengarang'] = [];

        return view('library.catalog.index', $data);
    }
}
