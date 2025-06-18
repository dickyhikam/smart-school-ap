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
        // Menyimpan foto jika diupload
        if ($request->hasFile('foto_guru')) {
            $imagePath = $request->file('foto_guru')->store('public/foto_guru');
        }

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
            'foto_guru' => $imagePath ?? null, // jika ada foto
        ];

        // Kirim data ke API
        $apiUrl = env('API_URL') . '/api/guru'; // URL API eksternal Anda
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Cek jika berhasil
        if ($response->successful()) {
            // simpan ke table users
            $guruData = $response->json();
            $guruId = $guruData['data']['id']; // Ambil ID siswa dari respons API

            return redirect()->route('pageGuru')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message'] ?? 'Terjadi kesalahan saat melakukan penambahan data.']);
    }

    public function store_update(Request $request, $id = null)
    {
        // Menyimpan foto jika diupload
        if ($request->hasFile('foto_guru')) {
            $imagePath = $request->file('foto_guru')->store('public/foto_guru');
        }

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
            'foto_guru' => $imagePath ?? null, // jika ada foto
        ];

        // Kirim data ke API
        $apiUrl = env('API_URL') . '/api/guru/' . $id; // URL API eksternal Anda
        $response = Http::withToken(session('token'))
            ->post($apiUrl, $data);
        $resultMessage = json_decode($response->body(), true);

        // Cek jika berhasil
        if ($response->successful()) {
            return redirect()->route('pageGuru')->with(['alert-type' => 'success', 'message' => $resultMessage['message']]);
        }

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $resultMessage['message'] ?? 'Terjadi kesalahan saat melakukan pembaruan data.']);
    }
}
