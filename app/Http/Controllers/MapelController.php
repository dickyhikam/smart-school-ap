<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Mata Pelajaran';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/akademik/mapel', [
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

        return view('akademik.data_master.mapel.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Mata Pelajaran';
        $data['nama_menu'] = $menu;
        $data['apiToken'] = session('token');
        $data['id_mapel'] = $id;

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            // URL API dengan parameter halaman
            $apiUrl = env('API_URL'); // URL API Anda
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/akademik/mapel/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array

            $data['nama_menu2'] = 'Form Edit ' . $menu;

            // dd($response['data']);
            $data['data_row'] = $response['data'];
            $data['action'] = route('actionEditMapel', $id); // Arahkan ke update
            $data['method'] = 'PUT'; // Menggunakan metode PUT untuk update
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddMapel'); // Arahkan ke store
            $data['method'] = 'POST'; // Menggunakan metode POST untuk create
        }

        return view('akademik.data_master.mapel.form', $data);
    }

    public function store(Request $request)
    {
        // Prepare data for sending to the API
        $data = [
            'nama' => $request->nama, // Menu nama
            'jenjang' => $request->jenjang,
        ];

        // Send data to the external API
        $apiUrl = env('API_URL') . '/api/akademik/mapel'; // External API URL for the menu
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pageMapel')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message']]);
    }

    public function store_update(Request $request, $id)
    {
        // Prepare data for sending to the API
        $data = [
            'nama' => $request->nama, // Menu nama
            'jenjang' => $request->jenjang,
        ];

        // Send data to the external API using PUT (for updating)
        $apiUrl = env('API_URL') . '/api/akademik/mapel/' . $id; // API URL for updating the menu by ID
        $response = Http::withToken(session('token'))
            ->put($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pageMapel')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message']]);
    }

    public function destroy($id)
    {
        // API URL to delete the menu by its ID
        $apiUrl = env('API_URL') . '/api/akademik/mapel/' . $id;

        // Send DELETE request to the API
        $response = Http::withToken(session('token'))->delete($apiUrl);

        $resultMessage = json_decode($response->body(), true);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pageMapel')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message']]);
    }
}
