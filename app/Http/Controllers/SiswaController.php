<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $data['nama_menu'] = 'Siswa';

        return view('management_user.siswa.index', $data);
    }
}
