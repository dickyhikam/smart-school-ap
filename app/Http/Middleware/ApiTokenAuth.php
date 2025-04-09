<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ApiTokenAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil token dari session
        $token = session('token');

        // Cek apakah token ada di session
        if (!$token) {
            // Jika tidak ada token, arahkan ke halaman login
            return Redirect::route('login')->with('message', 'You must be logged in to access this page.');
        }

        // Verifikasi token dengan API
        // $apiUrl = env('API_URL'); // URL API Anda
        // $response = Http::withToken($token)->get($apiUrl . '/api/validate-token'); // Gantilah dengan endpoint yang sesuai di API Anda

        // if ($response->failed()) {
        //     // Jika verifikasi gagal, logout dan arahkan ke login
        //     session()->flush(); // Hapus session
        //     return Redirect::route('login')->with('message', 'Invalid or expired token. Please log in again.');
        // }

        // Jika token valid, lanjutkan ke request berikutnya
        return $next($request);
    }
}
