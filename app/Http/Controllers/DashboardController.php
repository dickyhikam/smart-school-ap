<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Dashboard';

        return view('dashboard.index', $data);
    }
}
