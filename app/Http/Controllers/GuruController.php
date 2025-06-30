<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Guru';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/guru', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['list_data'] = $response['data']['items']; // Mengambil data guru
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

        return view('management_user.guru.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Guru';
        $data['nama_menu'] = $menu;

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            // URL API dengan parameter halaman
            $apiUrl = env('API_URL'); // URL API Anda
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/guru/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array

            $data['nama_menu2'] = 'Form Edit ' . $menu;

            $data['data_row'] = $response['data'];
            $data['action'] = route('actionEditGuru', $id); // Arahkan ke update
            $data['method'] = 'PUT'; // Menggunakan metode PUT untuk update
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddGuru'); // Arahkan ke store
            $data['method'] = 'POST'; // Menggunakan metode POST untuk create
        }

        return view('management_user.guru.form', $data);
    }

    public function store(Request $request)
    {
        // Persiapkan data untuk dikirim ke API
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'status_kepegawaian' => $request->status_kepegawaian,
            'tahun_masuk' => $request->tahun_masuk,
            'mata_pelajaran' => $request->mata_pelajaran ?? null, // jika tidak ada mata pelajaran
        ];

        // Kirim data ke API
        $apiUrl = env('API_URL') . '/api/guru'; // URL API eksternal Anda

        // Check if there is a photo file and upload the photo if present
        if ($request->hasFile('foto_guru')) {
            // Get the image file
            $file = $request->file('foto_guru');

            // Send a POST or PUT request to the API with the photo as binary data (multipart/form-data)
            $response = Http::withToken(session('token'))
                ->attach('foto_guru', file_get_contents($file), $file->getClientOriginalName()) // Attach the image as binary
                ->post($apiUrl, $data);
        } else {
            // If no photo is provided, send data without the photo
            $response = Http::withToken(session('token'))
                ->post($apiUrl, $data);
        }
        $resultMessage = json_decode($response->body(), true);

        // Cek jika berhasil
        if ($response->successful()) {
            // simpan ke table users
            $guruData = $response->json();
            $guruId = $guruData['data']['id']; // Ambil ID siswa dari respons API
            $userData = [
                'name' => $request->nama_lengkap,
                'username' => strtolower(str_replace(' ', '.', $request->nama_lengkap)),
                'email' => $request->email,
                'password' => 'DiSekolahJogja2025',
                'pengguna_id' => $guruId,
                'pengguna_type' => 'guru',
                'role' => 'guru',
            ];
            // Kirim data ke API
            $apiUrlUser = env('API_URL') . '/api/users'; // URL API eksternal Anda
            $responseUser = Http::withToken(session('token'))
                ->post($apiUrlUser, $userData);
            $resultMessageUser = json_decode($responseUser->body(), true);
            // Cek jika berhasil
            if ($resultMessageUser->successful()) {
                return redirect()->route('pageGuru')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
            }

            // If the request failed, redirect back with error message
            return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessageUser['message'] ?? 'Terjadi kesalahan saat melakukan penambahan data.']);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message'] ?? 'Terjadi kesalahan saat melakukan penambahan data.']);
    }

    public function store_update(Request $request, $id = null)
    {

        // Persiapkan data untuk dikirim ke API
        $data = [
            'nama_lengkap' => $request->nama_lengkap,
            'nip' => $request->nip,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'status_kepegawaian' => $request->status_kepegawaian,
            'tahun_masuk' => $request->tahun_masuk,
            'mata_pelajaran' => $request->mata_pelajaran ?? null, // jika tidak ada mata pelajaran
        ];

        // Kirim data ke API
        $apiUrl = env('API_URL') . '/api/guru/' . $id; // URL API eksternal Anda
        // Check if there is a photo file and upload the photo if present
        if ($request->hasFile('foto_guru')) {
            // Get the image file
            $file = $request->file('foto_guru');

            // Send a POST or PUT request to the API with the photo as binary data (multipart/form-data)
            $response = Http::withToken(session('token'))
                ->attach('foto_guru', file_get_contents($file), $file->getClientOriginalName()) // Attach the image as binary
                ->post($apiUrl, $data);
        } else {
            // If no photo is provided, send data without the photo
            $response = Http::withToken(session('token'))
                ->post($apiUrl, $data);
        }
        $resultMessage = json_decode($response->body(), true);

        // Cek jika berhasil
        if ($response->successful()) {
            $userData = [
                'name' => $request->nama_lengkap,
                'username' => strtolower(str_replace(' ', '.', $request->nama_lengkap)),
                'email' => $request->email,
                'role' => 'guru',
            ];
            // Kirim data ke API
            $apiUrlUser = env('API_URL') . '/api/users/' . $request->id_user; // URL API eksternal Anda
            $responseUser = Http::withToken(session('token'))
                ->put($apiUrlUser, $userData);
            $resultMessageUser = json_decode($responseUser->body(), true);
            // Cek jika berhasil
            if ($responseUser->successful()) {
                return redirect()->route('pageGuru')->with(['alert-type' => 'success', 'message' => $resultMessageUser['message']]);
            }

            // If the request failed, redirect back with error message
            return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessageUser['message'] ?? 'Terjadi kesalahan saat melakukan pembaruan data.']);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message'] ?? 'Terjadi kesalahan saat melakukan pembaruan data.']);
    }
}
