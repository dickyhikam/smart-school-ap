<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $data['nama_menu'] = 'Siswa';

        // Ambil nomor halaman, jumlah item per halaman, dan query pencarian
        $page = $request->input('page', 1); // default ke 1 jika tidak ada parameter page
        $perPage = $request->input('per_page', 10); // default ke 10 jika tidak ada parameter per_page
        $search = $request->input('search', ''); // query pencarian, default kosong

        // URL API dengan parameter halaman
        $apiUrl = env('API_URL'); // URL API Anda
        $response = Http::withToken(session('token'))
            ->get($apiUrl . '/api/siswa', [
                'page' => $page,
                'per_page' => $perPage, // Kirim parameter per_page
                'search' => $search, // Kirim parameter pencarian
            ]);
        $response = json_decode($response->body(), true); // Dekode response menjadi array

        $data['list_data'] = $response['data']['items']; // Mengambil data siswa
        // Mengambil data pagination
        $data['pagination'] = [
            'current_page' => $response['data']['current_page'],
            'last_page' => $response['data']['last_page'],
            'total' => $response['data']['total'],
            'per_page' => $response['data']['per_page'],
            'next_page_url' => $response['data']['next_page_url'],
            'prev_page_url' => $response['data']['prev_page_url'],
        ];

        return view('management_user.siswa.index', $data);
    }

    public function index_form($id = null)
    {
        $menu = 'Siswa';
        $data['nama_menu'] = $menu;

        if ($id) {
            // Jika $id ada, berarti ini adalah halaman Edit
            // URL API dengan parameter halaman
            $apiUrl = env('API_URL'); // URL API Anda
            $response = Http::withToken(session('token'))->get($apiUrl . '/api/siswa/' . $id);
            $response = json_decode($response->body(), true); // Dekode response menjadi array

            $data['nama_menu2'] = 'Form Edit ' . $menu;
            $data['nama_menu3'] = 'Form Edit Ayah';
            $data['nama_menu4'] = 'Form Edit Ibu';
            $data['nama_menu5'] = 'Form Edit Wali';
            $data['nama_menu6'] = 'Pas Foto ' . $menu;

            $data['data_row'] = $response['data'];
            $data['action'] = route('actionEditSiswa', $id); // Arahkan ke update
            $data['method'] = 'PUT'; // Menggunakan metode PUT untuk update

            //get data ortu
            $data_ortu = $response['data']['orang_tua'];

            // Memisahkan data berdasarkan hubungan
            $ayah = array_values(array_filter($data_ortu, function ($row) {
                return $row['hubungan'] === 'Ayah'; // Menyaring data yang memiliki hubungan 'Ayah'
            }));

            $ibu = array_values(array_filter($data_ortu, function ($row) {
                return $row['hubungan'] === 'Ibu'; // Menyaring data yang memiliki hubungan 'Ibu'
            }));

            $wali = array_values(array_filter($data_ortu, function ($row) {
                return $row['hubungan'] === 'Wali'; // Menyaring data yang memiliki hubungan 'Wali'
            }));

            // Jika hanya ada satu data, ambil data pertama
            $data['data_row_ayah'] = count($ayah) === 1 ? $ayah[0] : $ayah;
            $data['data_row_ibu'] = count($ibu) === 1 ? $ibu[0] : $ibu;
            $data['data_row_wali'] = count($wali) === 1 ? $wali[0] : $wali;
        } else {
            $data['nama_menu2'] = 'Form Tambah ' . $menu;
            $data['nama_menu3'] = 'Form Tambah Ayah';
            $data['nama_menu4'] = 'Form Tambah Ibu';
            $data['nama_menu5'] = 'Form Tambah Wali';
            $data['nama_menu6'] = 'Pas Foto ' . $menu;

            $data['data_row_ayah'] = [];
            $data['data_row_ibu'] = [];
            $data['data_row_wali'] = [];

            // Jika tidak ada $id, berarti ini adalah halaman Create
            $data['action'] = route('actionAddSiswa'); // Arahkan ke store
            $data['method'] = 'POST'; // Menggunakan metode POST untuk create
        }

        return view('management_user.siswa.form', $data);
    }

    public function store(Request $request)
    {
        // Menyimpan foto siswa jika diupload
        if ($request->hasFile('foto_siswa')) {
            $imagePath = $request->file('foto_siswa')->store('public/foto_siswa');
        }

        // Persiapkan data siswa untuk dikirim ke API
        $dataSiswa = [
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_pendidikan' => $request->status_pendidikan,
            'agama' => $request->agama,
            'tahun_masuk' => $request->tahun_masuk ?? null,
            'tahun_lulus' => $request->tahun_lulus ?? null,
            'golongan_darah' => $request->golongan_darah ?? null,
            'foto_siswa' => $imagePath ?? null, // jika ada foto siswa
        ];

        // Kirim data siswa ke API
        $apiUrlSiswa = env('API_URL') . '/api/siswa'; // URL API siswa eksternal Anda
        $responseSiswa = Http::withToken(session('token'))
            ->post($apiUrlSiswa, $dataSiswa);

        // Jika data siswa berhasil disimpan
        if ($responseSiswa->successful()) {
            $siswaData = $responseSiswa->json();
            $siswaId = $siswaData['data']['id']; // Ambil ID siswa dari respons API

            // Persiapkan data orangtua (ayah, ibu, wali)
            $dataAyah = [
                'nama_lengkap' => $request->nama_lengkap_ayah,       // Nama Lengkap Ayah
                'pekerjaan' => $request->pekerjaan_ayah,             // Pekerjaan Ayah
                'alamat' => $request->alamat_ayah,                   // Alamat Ayah
                'nomor_telepon' => $request->nomor_telepon_ayah,     // Nomor Telepon Ayah
                'email' => $request->email_ayah ?? null,             // Email Ayah (jika ada)
                'jenis_orang_tua' => 'Ayah',                          // Jenis Orang Tua
                'status_wali' => $request->wali == 'Ayah' ? 'Ya' : 'Tidak',  // Status Wali (misalnya jika Ayah jadi wali)
                'siswa' => [
                    [
                        'siswa_id' => $siswaId,
                        'hubungan' => 'Ayah',
                    ]
                ],
            ];

            $dataIbu = [
                'nama_lengkap' => $request->nama_lengkap_ibu,
                'pekerjaan' => $request->pekerjaan_ibu,
                'alamat' => $request->alamat_ibu,
                'nomor_telepon' => $request->nomor_telepon_ibu,
                'email' => $request->email_ibu ?? null,
                'jenis_orang_tua' => 'Ibu',
                'status_wali' => $request->wali == 'Ibu' ? 'Ya' : 'Tidak',
                'siswa' => [
                    [
                        'siswa_id' => $siswaId,
                        'hubungan' => 'Ibu',
                    ]
                ],
            ];

            // Kirim data ayah ke API
            $apiUrlAyah = env('API_URL') . '/api/orangtua'; // URL API orangtua eksternal Anda
            $responseAyah = Http::withToken(session('token'))
                ->post($apiUrlAyah, $dataAyah);

            // Cek jika response untuk ibu berhasil atau gagal
            if ($responseAyah->failed()) {
                // Menampilkan pesan error dari API
                $errorMessage = $responseAyah->json()['message'] . '(Data Ayah)' ?? 'Gagal menyimpan data ayah';
                return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
            }

            // Kirim data ibu ke API
            $apiUrlIbu = env('API_URL') . '/api/orangtua'; // URL API orangtua eksternal Anda
            $responseIbu = Http::withToken(session('token'))
                ->post($apiUrlIbu, $dataIbu);

            // Cek jika response untuk ibu berhasil atau gagal
            if ($responseIbu->failed()) {
                // Menampilkan pesan error dari API
                $errorMessage = $responseIbu->json()['message'] . '(Data Ibu)' ?? 'Gagal menyimpan data ibu';
                return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
            }

            // Jika ada wali yang perlu ditambahkan
            if ($request->has('wali') && $request->wali == 'Lain-lain') {
                $dataWali = [
                    'nama_lengkap' => $request->nama_lengkap_wali,
                    'pekerjaan' => $request->pekerjaan_wali,
                    'alamat' => $request->alamat_wali,
                    'nomor_telepon' => $request->nomor_telepon_wali,
                    'email' => $request->email_wali ?? null,
                    'jenis_orang_tua' => 'Wali',
                    'status_wali' => $request->wali == 'Lain-lain' ? 'Ya' : 'Tidak',
                    'siswa' => [
                        [
                            'siswa_id' => $siswaId,
                            'hubungan' => 'Wali',
                        ]
                    ],
                ];

                // Kirim data wali ke API
                $apiUrlWali = env('API_URL') . '/api/orangtua'; // URL API orangtua eksternal Anda
                $responseWali = Http::withToken(session('token'))
                    ->post($apiUrlWali, $dataWali);

                // Cek jika response untuk ibu berhasil atau gagal
                if ($responseWali->failed()) {
                    // Menampilkan pesan error dari API
                    $errorMessage = $responseWali->json()['message'] . '(Data Wali)' ?? 'Gagal menyimpan data wali';
                    return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
                }
            }

            // Jika data siswa dan orangtua berhasil disimpan
            return redirect()->route('pageSiswa')->with(['alert-type' => 'success', 'message' => 'Data Siswa berhasil disimpan!']);
        }

        // Jika gagal menyimpan data siswa
        return back()->with(['alert-type' => 'error', 'message' => $responseSiswa->json()['message']]);
    }

    public function store_update(Request $request)
    {
        // Menyimpan foto siswa jika diupload
        if ($request->hasFile('foto_siswa')) {
            $imagePath = $request->file('foto_siswa')->store('public/foto_siswa');
        }

        // Persiapkan data siswa untuk dikirim ke API
        $dataSiswa = [
            'nisn' => $request->nisn,
            'nama_lengkap' => $request->nama_lengkap,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_pendidikan' => $request->status_pendidikan,
            'agama' => $request->agama,
            'tahun_masuk' => $request->tahun_masuk ?? null,
            'tahun_lulus' => $request->tahun_lulus ?? null,
            'golongan_darah' => $request->golongan_darah ?? null,
            'foto_siswa' => $imagePath ?? null, // jika ada foto siswa
        ];

        // Kirim data siswa ke API
        $apiUrlSiswa = env('API_URL') . '/api/siswa/' . $request->id; // URL API siswa eksternal Anda
        $responseSiswa = Http::withToken(session('token'))
            ->post($apiUrlSiswa, $dataSiswa);

        // Jika data siswa berhasil disimpan
        if ($responseSiswa->successful()) {
            $siswaData = $responseSiswa->json();
            $siswaId = $siswaData['data']['id']; // Ambil ID siswa dari respons API

            // Persiapkan data orangtua (ayah, ibu, wali)
            $dataAyah = [
                'nama_lengkap' => $request->nama_lengkap_ayah,       // Nama Lengkap Ayah
                'pekerjaan' => $request->pekerjaan_ayah,             // Pekerjaan Ayah
                'alamat' => $request->alamat_ayah,                   // Alamat Ayah
                'nomor_telepon' => $request->nomor_telepon_ayah,     // Nomor Telepon Ayah
                'email' => $request->email_ayah ?? null,             // Email Ayah (jika ada)
                'jenis_orang_tua' => 'Ayah',                          // Jenis Orang Tua
                'status_wali' => $request->wali == 'Ayah' ? 'Ya' : 'Tidak',  // Status Wali (misalnya jika Ayah jadi wali)
                'siswa' => [
                    [
                        'siswa_id' => $siswaId,
                        'hubungan' => 'Ayah',
                    ]
                ],
            ];

            $dataIbu = [
                'nama_lengkap' => $request->nama_lengkap_ibu,
                'pekerjaan' => $request->pekerjaan_ibu,
                'alamat' => $request->alamat_ibu,
                'nomor_telepon' => $request->nomor_telepon_ibu,
                'email' => $request->email_ibu ?? null,
                'jenis_orang_tua' => 'Ibu',
                'status_wali' => $request->wali == 'Ibu' ? 'Ya' : 'Tidak',
                'siswa' => [
                    [
                        'siswa_id' => $siswaId,
                        'hubungan' => 'Ibu',
                    ]
                ],
            ];

            // Kirim data ayah ke API
            $apiUrlAyah = env('API_URL') . '/api/orangtua/' . $request->id_ayah;
            $responseAyah = Http::withToken(session('token'))
                ->post($apiUrlAyah, $dataAyah);

            // Cek jika response untuk ayah berhasil atau gagal
            if ($responseAyah->failed()) {
                // Menampilkan pesan error dari API
                $errorMessage = $responseAyah->json()['message'] . '(Data Ayah)' ?? 'Gagal menyimpan data ayah';
                return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
            }

            // Kirim data ibu ke API
            $apiUrlIbu = env('API_URL') . '/api/orangtua/' . $request->id_ibu;
            $responseIbu = Http::withToken(session('token'))
                ->post($apiUrlIbu, $dataIbu);

            // Cek jika response untuk ibu berhasil atau gagal
            if ($responseIbu->failed()) {
                // Menampilkan pesan error dari API
                $errorMessage = $responseIbu->json()['message'] . '(Data Ibu)' ?? 'Gagal menyimpan data ibu';
                return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
            }


            // Jika ada wali yang perlu ditambahkan
            if ($request->has('wali') && $request->wali == 'Lain-lain') {
                $dataWali = [
                    'nama_lengkap' => $request->nama_lengkap_wali,
                    'pekerjaan' => $request->pekerjaan_wali,
                    'alamat' => $request->alamat_wali,
                    'nomor_telepon' => $request->nomor_telepon_wali,
                    'email' => $request->email_wali ?? null,
                    'jenis_orang_tua' => 'Wali',
                    'status_wali' => $request->wali == 'Lain-lain' ? 'Ya' : 'Tidak',
                    'siswa' => [
                        [
                            'siswa_id' => $siswaId,
                            'hubungan' => 'Wali',
                        ]
                    ],
                ];

                // Kirim data wali ke API
                $apiUrlWali = env('API_URL') . '/api/orangtua/' . $request->id_wali; // URL API orangtua eksternal Anda
                $responseWali = Http::withToken(session('token'))
                    ->post($apiUrlWali, $dataWali);

                // Cek jika response untuk wali berhasil atau gagal
                if ($responseWali->failed()) {
                    // Menampilkan pesan error dari API
                    $errorMessage = $responseWali->json()['message'] . '(Data Wali)' ?? 'Gagal menyimpan data wali';
                    return back()->with(['alert-type' => 'error', 'message' => $errorMessage]);
                }
            }

            // Jika data siswa dan orangtua berhasil disimpan
            return redirect()->route('pageSiswa')->with(['alert-type' => 'success', 'message' => 'Data Siswa berhasil disimpan!']);
        }

        // Jika gagal menyimpan data siswa
        return back()->with(['alert-type' => 'error', 'message' => $responseSiswa->json()['message']]);
    }
}
