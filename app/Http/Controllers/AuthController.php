<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Auth';

        // Periksa apakah token ada di sesi atau cookie
        $token = session('token') ?? $request->cookie('access_token');

        // Jika token ada, anggap pengguna sudah login
        if ($token) {
            // Pengguna sudah login, bisa menampilkan dashboard atau halaman lainnya
            // Anda bisa mengganti view sesuai kebutuhan Anda, misalnya 'dashboard.index'
            return redirect()->route('pageDashboard'); // Misalnya, mengarahkan ke dashboard
        }

        // Jika token tidak ada, pengguna belum login, tetap tampilkan halaman login
        return view('auth.index', $data);
    }

    public function login(Request $request)
    {
        // Ambil URL API dari .env
        $apiUrl = env('API_URL'); // Ini akan mengambil https://api.example.com/

        // Ambil input dari form
        $username = $request->input('username');
        $password = $request->input('password');
        $remember = $request->has('remember'); // Cek apakah "Remember me" dicentang

        // Kirim request ke API untuk login
        $response = Http::post($apiUrl . '/api/login', [
            'username' => $username,
            'password' => $password,
        ]);

        // Cek apakah request berhasil
        if ($response->successful()) {
            $data = $response->json();

            // Ambil token akses dari response
            $accessToken = $data['data']['token']['access_token'];

            // Simpan token ke session
            session(['token' => $accessToken]);

            // Simpan role dan permissions ke session
            session(['role' => $data['data']['user']['role']['name']]);
            session(['permissions' => $data['data']['user']['role']['permissions']]);

            // Simpan data user ke session
            session(['user' => $data['data']['user']]);

            // Jika "Remember me" dicentang, simpan token ke cookie
            if ($remember) {
                // Simpan token ke cookie selama 30 hari
                Cookie::queue('access_token', $accessToken, 43200); // 43200 menit = 30 hari
            }

            // Redirect ke halaman dashboard atau halaman lain setelah berhasil login
            return redirect()->route('pageDashboard');
        }

        // Menampilkan pesan error dari API
        $errorMessage = $response->json()['message'] ?? 'NIP/NIS atau Password Salah';
        return back()->with(['alert-type' => 'error', 'message' => $errorMessage])->withInput();
    }

    public function logout(Request $request)
    {
        // Hapus sesi dan cookie yang terkait dengan token akses
        Session::forget('token');
        Session::forget('role');
        Session::forget('permissions');
        Session::forget('user');

        // Hapus cookie 'access_token' jika ada
        Cookie::queue(Cookie::forget('access_token'));

        // Redirect ke halaman login atau halaman lain setelah logout
        return redirect()->route('login');
    }
}
