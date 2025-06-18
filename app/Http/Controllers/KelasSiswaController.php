<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KelasSiswaController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Siswa Kelas';
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

            // Langsung cek jika tidak ada data, alihkan ke route pageTahunAjaran
            if (empty($response_ta['data']['items'])) {
                return redirect()->route('pageTahunAjaran')->with(['alert-type' => 'error', 'message' => "Data tahun ajaran tidak ditemukan. Mohon menginputkan data tahun ajaran terlebih dahulu!"]);
            }

            $tahun_ajaran = $response_ta['data']['items'][0]['tahun_ajaran'];
            $ta_code = $response_ta['data']['items'][0]['id'];
            $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
            $tahun_ajaran_next = $response_ta['data']['additional_years'][1]['tahun_ajaran'] ?? '';
            $tahun_ajaran_status = $response_ta['data']['items'][0]['status']['label'];

            //pecah dan cek data tahun ajaran
            $tahun_ajaran_pisah = explode("/", $tahun_ajaran);
            $tahun_ajaran_prev_pisah = explode("/", $tahun_ajaran_prev);
            if ($tahun_ajaran_next == '') {
                if ($tahun_ajaran_pisah[0] > $tahun_ajaran_prev_pisah[0]) {
                    $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
                    $tahun_ajaran_next = '';
                } else {
                    $tahun_ajaran_prev = '';
                    $tahun_ajaran_next = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
                }
            }
        } else {
            $response_ta = Http::withToken(session('token'))
                ->get($apiUrl . '/api/akademik/tahun-ajaran', [
                    'tahun' => $tahun_ajaran,
                ]);
            $response_ta = json_decode($response_ta->body(), true); // Dekode response menjadi array

            // Langsung cek jika tidak ada data, alihkan ke route pageTahunAjaran
            if (empty($response_ta['data']['items'])) {
                return redirect()->route('pageTahunAjaran')->with(['alert-type' => 'error', 'message' => "Data tahun ajaran tidak ditemukan. Mohon menginputkan data tahun ajaran terlebih dahulu!"]);
            }

            $tahun_ajaran = $response_ta['data']['items'][0]['tahun_ajaran'];
            $ta_code = $response_ta['data']['items'][0]['id'];
            $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
            $tahun_ajaran_next = $response_ta['data']['additional_years'][1]['tahun_ajaran'] ?? '';
            $tahun_ajaran_status = $response_ta['data']['items'][0]['status']['label'];

            //pecah dan cek data tahun ajaran
            $tahun_ajaran_pisah = explode("/", $tahun_ajaran);
            $tahun_ajaran_prev_pisah = explode("/", $tahun_ajaran_prev);
            if ($tahun_ajaran_next == '') {
                if ($tahun_ajaran_pisah[0] > $tahun_ajaran_prev_pisah[0]) {
                    $tahun_ajaran_prev = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
                    $tahun_ajaran_next = '';
                } else {
                    $tahun_ajaran_prev = '';
                    $tahun_ajaran_next = $response_ta['data']['additional_years'][0]['tahun_ajaran'] ?? '';
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
        // dd($response['data']['items']);

        $listSubKelas = $response['data']['items']; // Mengambil data siswa
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

        $list_data_with_siswa = [];

        foreach ($listSubKelas as $row) {
            // Ambil sub_kelas_id dari data yang sudah diterima
            $sub_kelas_id = $row['id'];

            // Panggil API kedua untuk mendapatkan data siswa berdasarkan sub_kelas_id
            $response_siswa_kelas = Http::withToken(session('token'))
                ->get($apiUrl . '/api/akademik/kelas-siswa', [
                    'sub_kelas_id' => $sub_kelas_id,
                ]);
            $response_siswa_kelas = json_decode($response_siswa_kelas->body(), true);
            // dd($response_siswa_kelas);

            // Menambahkan data siswa ke dalam row
            $row['siswa'] = $response_siswa_kelas['data']; // Asumsi bahwa data siswa ada di field 'data'

            // Menyimpan data yang sudah dilengkapi
            $list_data_with_siswa[] = $row;
        }

        // Sekarang $list_data_with_siswa berisi data subkelas dengan data siswa terkait
        $data['list_data'] = $list_data_with_siswa;

        return view('akademik.kelas_siswa.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Siswa Kelas';
        $data['nama_menu'] = $menu;
        $apiUrl = env('API_URL'); // URL API Anda
        $data['apiToken'] = session('token');

        // Jika $id ada, berarti ini adalah halaman Edit
        $data['nama_menu2'] = 'Detil ' . $menu;
        $data['id_kelas'] = $id;

        // URL API get data sub kelas
        $response = Http::withToken(session('token'))->get($apiUrl . '/api/akademik/sub-kelas/' . $id);
        $response = json_decode($response->body(), true); // Dekode response menjadi array
        $data['data_row'] = $response['data'];

        return view('akademik.kelas_siswa.form', $data);
    }
}
