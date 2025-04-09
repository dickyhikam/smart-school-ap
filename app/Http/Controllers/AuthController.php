<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {
        $data['nama_menu'] = 'Auth';

        return view('auth.index', $data);
    }

    public function login(Request $request)
    {
        // Ambil URL API dari .env
        $apiUrl = env('API_URL'); // Ini akan mengambil https://api.example.com/

        // Ambil input dari form
        $username = $request->input('username');
        $password = $request->input('password');

        // Kirim request ke API untuk login
        $response = Http::post($apiUrl . '/api/login', [
            'username' => $username,
            'password' => $password,
        ]);

        // Cek apakah request berhasil
        if ($response->successful()) {
            $data = $response->json();

            // Simpan token ke session atau buat logika autentikasi di sini
            session(['token' => $data['data']['token']['access_token']]); // Contoh menyimpan token

            // Redirect ke halaman dashboard atau halaman lain setelah berhasil login
            return redirect()->route('pageDashboard');
        }

        // Menampilkan pesan error dari API
        $errorMessage = $response->json()['message'] ?? 'NIP/NIS atau Password Salah';
        return back()->with(['alert-type' => 'error', 'message' => $errorMessage])->withInput();
    }
}
