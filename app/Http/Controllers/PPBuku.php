<?php

namespace App\Http\Controllers;

// use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Spatie\LaravelPdf\Facades\Pdf;

class PPBuku extends Controller
{
    // protected $pdf;

    // // Inject the PDF service into the controller
    // public function __construct(PDF $pdf)
    // {
    //     $this->pdf = $pdf;
    // }

    public function index(Request $request)
    {
        $data['nama_menu'] = 'Buku';
        $data['con_menu'] = 'Perpustakaan';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/buku', [
                'page' => $page,
                'perPage' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array
        // dd($response);

        $data['list_data'] = $response['data']['items']; // Mengambil data siswa
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

        return view('library.data_master.buku.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Buku';
        $data['nama_menu'] = $menu;
        $data['nama_menu2'] = 'Form ' . $menu;
        $data['con_menu'] = 'Perpustakaan';
        $apiUrl = env('API_URL'); // URL API Anda
        //date now
        $data['date_now'] = Carbon::now()->format('Y-m-d');
        $data['id_data'] = $id;
        $data['token'] = session('token');

        $response_kategori = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/kategori-buku');
        $response_kategori = json_decode($response_kategori->body(), true);
        $data['list_kategori'] = $response_kategori['data']['items'];

        $response_pengarang = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/pengarang');
        $response_pengarang = json_decode($response_pengarang->body(), true);
        $data['list_pengarang'] = $response_pengarang['data']['items'];

        $response_penerbit = Http::withToken(session('token'))
            ->get($apiUrl . '/api/perpustakaan/penerbit');
        $response_penerbit = json_decode($response_penerbit->body(), true);
        $data['list_penerbit'] = $response_penerbit['data']['items'];

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            // URL API dengan parameter halaman
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/perpustakaan/buku/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array

            $data['nama_menu2'] = 'Form Edit ' . $menu;

            $data['data_row'] = $response['data'];
            $data['action'] = route('actionAddPerpusBuku', $id); // Arahkan ke update
            $data['con_hid'] = '';
            $data['con_col1'] = 'col-sm-7';
            $data['con_col2'] = 'col-sm-5';

            // dd($data['data_row']);
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;
            $data['data_row'] = [];
            $data['con_hid'] = 'hidden';
            $data['con_col1'] = 'col-sm-12';
            $data['con_col2'] = '';

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddPerpusBuku'); // Arahkan ke store
        }

        return view('library.data_master.buku.form', $data);
    }

    public function store(Request $request, $id = null)
    {
        // Mengubah format tanggal_pengadaan ke format yang diinginkan (YYYY-MM-DD)
        $tanggalPengadaan = Carbon::parse($request->tanggal_pengadaan)->format('Y-m-d');

        // Prepare data for sending to the API
        $data = [
            'judul' => $request->judul,
            'tahun_terbit' => $request->tahun_terbit,
            'tanggal_pengadaan' => $tanggalPengadaan,
            'jumlah' => $request->jumlah,
            'rak_kode' => $request->rak_kode,
            'pengarang_id' => $request->pengarang_id,
            'penerbit_id' => $request->penerbit_id,
            'keterangan' => $request->keterangan,
        ];

        // Initialize kategori_ids as an array
        $kategoriIds = [];
        foreach ($request->kategori_id as $kategori_id) {
            // Simply add kategori_id to the array
            $kategoriIds[] = $kategori_id;
        }
        // Now assign the kategori_ids array to data
        $data['kategori_ids'] = $kategoriIds;

        // Define the API URL based on whether we're updating or creating
        $apiUrl = env('API_URL') . '/api/perpustakaan/buku' . ($id ? "/{$id}" : '');

        // Determine HTTP method (POST for store, PUT for update)
        $method = $id ? 'put' : 'post';

        // Check if there is a photo file and upload the photo if present
        if ($request->hasFile('gambar_cover')) {
            // Get the image file
            $file = $request->file('gambar_cover');

            // Send a POST or PUT request to the API with the photo as binary data (multipart/form-data)
            $response = Http::withToken(session('token'))
                ->attach('gambar', file_get_contents($file), $file->getClientOriginalName()) // Attach the image as binary
                ->$method($apiUrl, $data);
        } else {
            // If no photo is provided, send data without the photo
            $response = Http::withToken(session('token'))
                ->$method($apiUrl, $data);
        }

        // Check if the request was successful
        if ($response->successful()) {
            // If successful, redirect with success message
            $message = $id ? 'Buku berhasil diperbarui!' : 'Buku berhasil disimpan!';
            return redirect()->route('pagePerpusBuku')->with(['alert-type' => 'success', 'message' => $message]);
        }

        // If there was an error, capture the error message
        $errorMessage = json_decode($response->body(), true);  // Capture the error message from the response body

        // If the request failed, redirect back with error message
        return back()->withInput()->with(['alert-type' => 'error', 'message' => $errorMessage['message']]);
    }

    public function printBuku($id)
    {
        $apiUrl = env('API_URL'); // URL API Anda
        // URL API dengan parameter halaman
        $response = Http::withToken(session('token'))->get($apiUrl . '/api/perpustakaan/buku/' . $id);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['data_buku'] = $response['data'];
        // $buku = Buku::findOrFail($id); // Get the Buku data by id

        // $pdf = $this->pdf->loadView('library.data_master.buku.print', $data); // Load view and pass data to it

        // // return $pdf->download('kode_buku_' . $id . '.pdf'); // Return the PDF for download
        // return $pdf->stream('preview_buku_' . $id . '.pdf'); // Return PDF for preview in the browser

        return Pdf::view('library.data_master.buku.print', $data)
            ->format('a4')
            ->name('your-invoice.pdf');
    }
}
