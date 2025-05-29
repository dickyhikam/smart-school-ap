<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Jadwal';
        $apiUrl = env('API_URL'); // URL API Anda

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

        // URL API sub kelas
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/akademik/sub-kelas', [
                'tahun_ajaran' => $tahun_ajaran,
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['listSubKelas'] = $response['data']['items']; // Mengambil data siswa

        return view('akademik.jadwal.index', $data);
    }
}
