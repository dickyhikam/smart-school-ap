<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PPCatalog extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Catalog';
        $apiUrl = env('API_URL'); // URL API Anda
        $data['apiUrl'] = $apiUrl; // URL API Anda
        $data['key'] = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDel5ktrGMXidf0n0K';

        //get token
        $response_token = Http::withHeaders([
            'X-Private-Key' => $data['key'], // Private key
        ])
            ->post($apiUrl . '/api/token');
        $response_token = json_decode($response_token->body(), true); // Dekode response menjadi array
        $data['apiToken'] = $response_token['token'];
        $data['exToken'] = $response_token['expires_at'];

        //get data category
        $response_category = Http::withToken($data['apiToken'])
            ->get($apiUrl . '/api/perpustakaan/kategori-buku');
        $response_category = json_decode($response_category->body(), true); // Dekode response menjadi array
        $data['list_category'] = $response_category['data']['items'];

        //get data penerbit
        $response_penerbit = Http::withToken($data['apiToken'])
            ->get($apiUrl . '/api/perpustakaan/penerbit');
        $response_penerbit = json_decode($response_penerbit->body(), true); // Dekode response menjadi array
        $data['list_penerbit'] = $response_penerbit['data']['items'];

        //get data pengarang
        $response_pengarang = Http::withToken($data['apiToken'])
            ->get($apiUrl . '/api/perpustakaan/pengarang');
        $response_pengarang = json_decode($response_pengarang->body(), true); // Dekode response menjadi array
        $data['list_pengarang'] = $response_pengarang['data']['items'];

        return view('library.catalog.index', $data);
    }
}
