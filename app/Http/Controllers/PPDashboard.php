<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPDashboard extends Controller
{
    public function index()
    {
        $data['nama_menu'] = 'Dashboard';
        $data['con_menu'] = 'Perpustakaan';

        return view('library.dashboard.index', $data);
    }
}
