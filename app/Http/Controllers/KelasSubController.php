<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelasSubController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Sub Kelas';
        $apiUrl = env('API_URL'); // URL API Anda

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong
        $tahun_ajaran = $request->input('th', '');
        if ($tahun_ajaran == '') {
            $response_ta = Http::withToken(session('token'))
                ->get($apiUrl . '/api/akademik/tahun-ajaran', [
                    'status' => 1,
                ]);
            $response_ta = json_decode($response_ta->body(), true); // Dekode response menjadi array
            $tahun_ajaran = $response_ta['data']['items'][0]['tahun_ajaran'];
            $ta_code = $response_ta['data']['items'][0]['id'];
            $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
            $tahun_ajaran_next = $response_ta['data']['additional_years'][1]['tahun_ajaran'] ?? '';
            $tahun_ajaran_status = $response_ta['data']['items'][0]['status']['label'];

            //pecah dan cek data tahun ajaran
            $tahun_ajaran_pisah = explode("/", $tahun_ajaran);
            $tahun_ajaran_prev_pisah = explode("/", $tahun_ajaran_prev);
            if ($tahun_ajaran_next == '') {
                if ($tahun_ajaran_pisah[0] > $tahun_ajaran_prev_pisah[0]) {
                    $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
                    $tahun_ajaran_next = '';
                } else {
                    $tahun_ajaran_prev = '';
                    $tahun_ajaran_next = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
                }
            }
        } else {
            $response_ta = Http::withToken(session('token'))
                ->get($apiUrl . '/api/akademik/tahun-ajaran', [
                    'tahun' => $tahun_ajaran,
                ]);
            $response_ta = json_decode($response_ta->body(), true); // Dekode response menjadi array
            $tahun_ajaran = $response_ta['data']['items'][0]['tahun_ajaran'];
            $ta_code = $response_ta['data']['items'][0]['id'];
            $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
            $tahun_ajaran_next = $response_ta['data']['additional_years'][1]['tahun_ajaran'] ?? '';
            $tahun_ajaran_status = $response_ta['data']['items'][0]['status']['label'];

            //pecah dan cek data tahun ajaran
            $tahun_ajaran_pisah = explode("/", $tahun_ajaran);
            $tahun_ajaran_prev_pisah = explode("/", $tahun_ajaran_prev);
            if ($tahun_ajaran_next == '') {
                if ($tahun_ajaran_pisah[0] > $tahun_ajaran_prev_pisah[0]) {
                    $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
                    $tahun_ajaran_next = '';
                } else {
                    $tahun_ajaran_prev = '';
                    $tahun_ajaran_next = $response_ta['data']['additional_years'][0]['tahun_ajaran'];
                }
            }
        }
        $data['tahun_ajaran'] = $tahun_ajaran;
        $data['ta_code'] = $ta_code;
        $data['tahun_ajaran_prev'] = $tahun_ajaran_prev;
        $data['tahun_ajaran_next'] = $tahun_ajaran_next;
        $data['tahun_ajaran_status'] = $tahun_ajaran_status;

        // URL API dengan parameter halaman
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/akademik/sub-kelas', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
                'tahun_ajaran' => $tahun_ajaran,
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

        return view('akademik.kelas_sub.index', $data);
    }

    public function index_form($th = null, $id = null)
    {
        $menu = 'Sub Kelas';
        $data['nama_menu'] = $menu;
        $apiUrl = env('API_URL'); // URL API Anda

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            $data['nama_menu2'] = 'Form Edit ' . $menu;

            // URL API dengan parameter halaman
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/akademik/sub-kelas/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array
            $data['data_row'] = $response['data'];

            $data['action'] = route('actionEditKelasSub', $id); // Arahkan ke update
            $data['method'] = 'PUT'; // Menggunakan metode PUT untuk update
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddKelasSub'); // Arahkan ke store
            $data['method'] = 'POST'; // Menggunakan metode POST untuk create
        }

        //get kelas
        $response_kelas = Http::withToken(session('token'))->get($apiUrl . '/api/akademik/kelas');
        $response_kelas = json_decode($response_kelas->body(), true); // Dekode response menjadi array
        $data['list_kelas'] = $response_kelas['data']['items'];

        //get guru
        $response_guru = Http::withToken(session('token'))->get($apiUrl . '/api/guru');
        $response_guru = json_decode($response_guru->body(), true); // Dekode response menjadi array
        $data['list_guru'] = $response_guru['data']['items'];

        //get data tahun ajaran
        $response_ta = Http::withToken(session('token'))->get($apiUrl . '/api/akademik/tahun-ajaran/' . $th);
        $response_ta = json_decode($response_ta->body(), true); // Dekode response menjadi array
        $data['data_ta'] = $response_ta['data'];

        return view('akademik.kelas_sub.form', $data);
    }

    public function store(Request $request)
    {
        // Prepare data for sending to the API
        $data = [
            'kelas_id' => $request->kelas,
            'jurusan_id' => $request->jurusan,
            'tahun_ajaran_id' => $request->tahun_ajaran,
            'wali_kelas_id' => $request->wali_kelas,
            'nama' => $request->nama,
            'status' => $request->status_sk,
        ];

        // Send data to the external API
        $apiUrl = env('API_URL') . '/api/akademik/sub-kelas'; // External API URL for the menu
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pageKelasSub')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message']]);
    }

    public function store_update(Request $request, $id)
    {
        // Prepare data for sending to the API
        $data = [
            'kelas_id' => $request->kelas,
            'jurusan_id' => $request->jurusan,
            'tahun_ajaran_id' => $request->tahun_ajaran,
            'wali_kelas_id' => $request->wali_kelas,
            'nama' => $request->nama,
            'status' => $request->status_sk,
        ];

        // Send data to the external API using PUT (for updating)
        $apiUrl = env('API_URL') . '/api/akademik/sub-kelas/' . $id; // API URL for updating the menu by ID
        $response = Http::withToken(session('token'))
            ->put($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            return redirect()->route('pageKelasSub')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message']]);
    }
}
