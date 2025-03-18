<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrtuController extends Controller
{
    public function index()
    {
        $data['nama_menu'] = 'Orang Tua';

        return view('management_user.ortu.index', $data);
    }
}
