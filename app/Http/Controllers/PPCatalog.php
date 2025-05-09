<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PPCatalog extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Catalog';

        return view('library.catalog.index', $data);
    }
}
