<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        $data['nama_menu'] = 'Guru';

        return view('management_user.guru.index', $data);
    }
}
