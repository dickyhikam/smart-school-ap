@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<style>
    /* Menambahkan efek hover pada list item */
    .list-group-item.clickable {
        cursor: pointer;
        /* Menambahkan pointer saat item diklik */
        transition: background-color 0.3s ease, transform 0.2s ease;
        display: flex;
        /* Gunakan flexbox untuk memposisikan NISN dan Nama */
        justify-content: flex-start;
        /* Menyusun NISN dan Nama secara horizontal */
        align-items: center;
        /* Vertikal align untuk kesejajaran teks */
    }

    /* Efek hover untuk memberikan indikasi item bisa diklik */
    .list-group-item.clickable:hover {
        background-color: #f1f1f1;
        /* Warna latar belakang saat hover */
        transform: scale(1.05);
        /* Membesarkan sedikit saat hover */
    }

    /* Menata elemen NISN */
    .nisn {
        font-weight: bold;
        margin-right: 10px;
        /* Memberikan jarak antara NISN dan pemisah */
    }

    /* Menata elemen Nama */
    .nama {
        font-style: italic;
    }

    /* Menambah jarak setelah | pemisah */
    .list-group-item .nisn+span {
        padding-left: 10px;
    }

    /* Menambahkan border di antara kolom */
    .list-group-item .col-sm-6 {
        border-right: 1px solid #ddd;
        /* Garis pemisah */
        padding-right: 10px;
        /* Menambahkan jarak antara konten dan garis */
    }

    /* Menghapus border pada kolom terakhir */
    .list-group-item .col-sm-6:last-child {
        border-right: none;
    }

    /* Kontainer loading */
    .loading-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        /* Menempatkan elemen secara horizontal di tengah */
        align-items: center;
        /* Menempatkan elemen secara vertikal di tengah */
        /* height: 100vh; */
        /* Menggunakan tinggi penuh viewport */
        text-align: center;
        /* Menyelaraskan teks dengan spinner */
        /* background-color: rgba(213, 213, 213, 0.8); */
        /* Memberikan latar belakang transparan */
    }

    /* Spinner dengan animasi */
    .spinner-border {
        width: 3rem;
        height: 3rem;
        border-width: 0.5rem;
        animation: spin 1s linear infinite;
        /* Menambahkan animasi rotasi */
    }

    /* Teks loading */
    .loading-text {
        margin-top: 10px;
        font-size: 1.2rem;
        /* font-weight: bold; */
    }

    /* Animasi putaran spinner */
    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Data Kelas
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tahun Ajaran -->
                    <div class="row">
                        <label for="ta" class="col-md-3 col-form-label text-muted">Tahun Ajaran</label>
                        <div class="col-md-9">
                            <div class="info-box">
                                <span class="info-text">{{ $data_row['tahun_ajaran']['tahun_ajaran'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas -->
                    <div class="row">
                        <label for="kelas" class="col-md-3 col-form-label text-muted">Kelas</label>
                        <div class="col-md-9">
                            <div class="info-box">
                                <span class="info-text">{{ $data_row['kelas']['nama'] ?? 'N/A' }} {{ $data_row['jurusan']['nama'] ?? '' }} {{ $data_row['nama'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Wali Kelas -->
                    <div class="row">
                        <label for="wali_kelas" class="col-md-3 col-form-label text-muted">Wali Kelas</label>
                        <div class="col-md-9">
                            <div class="info-box">
                                <span class="info-text">{{ $data_row['wali_kelas']['nama_lengkap'] ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-secondary" id="submitButton">
                                    <i class="bi bi-arrow-left-circle"></i> Kembali
                                </button>
                            </div>
                        </div>
                        @if(isset($data_row['kelas']['jenjang']))
                        @if($data_row['kelas']['jenjang'] > 1)
                        <div class="col-sm-8">
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-primary" id="submitButton">
                                    <i class="bi bi-arrow-left-circle"></i> Tambah Siswa Kelas Dari Kelas Sebelumnya
                                </button>
                            </div>
                        </div>
                        @else
                        <div class="col-sm-8">
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-info" id="submitButton">
                                    <i class="bi bi-arrow-left-circle"></i> Tambah Siswa Kelas Random
                                </button>
                            </div>
                        </div>
                        @endif
                        @endif
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Siswa Kelas
                    </h4>
                </div>
                <div class="card-body">
                    <ul id="listSiswa" class="list-group"></ul>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-6">
            @if(isset($data_row['kelas']['jenjang']))
            @if($data_row['kelas']['jenjang'] > 1)
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Siswa Kelas Sebelumnya
                    </h4>
                </div>
                <div class="card-body">
                    <ul id="listSiswaSebelah" class="list-group"></ul>
                </div> <!-- end card body-->
            </div> <!-- end card -->
            @endif
            @endif

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Cari Siswa Kelas Lain
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 position-relative">
                        <input type="text" id="cari_siswa" class="form-control" placeholder="Cari siswa" data-bs-toggle="tooltip" title="Masukkan nama/nisn siswa" oninput="searchSiswa()">
                        <!-- Dropdown hasil pencarian -->
                        <ul id="searchResultsSiswa" class="list-group" style="width: 100%; display: none; padding: 11px;">
                            <!-- <ul id="searchResultsSiswa" class="list-group" style="width: 100%;"></ul> -->
                        </ul>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

    </div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    $(document).ready(function() {
        siswaKelas();
    });

    // Fungsi pencarian siswa
    function searchSiswa() {
        const input = document.getElementById('cari_siswa');
        const searchResults = document.getElementById('searchResultsSiswa');
        const searchTerm = input.value.toLowerCase();

        // Tampilkan loading spinner sebelum request dimulai
        const loadingHtml = `
            <div class="loading-container text-center py-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="loading-text mt-2">Memuat data siswa...</p>
            </div>
        `;
        $('#searchResultsSiswa').html(loadingHtml).show();

        $.ajax({
            url: '{{ env("API_URL") . "/api/siswa" }}',
            method: 'GET',
            data: {
                'search': searchTerm
            },
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}'
            },
            success: function(response) {
                if (response.data.items.length > 0) {
                    let resultsHtml = '';
                    response.data.items.forEach(function(row) {
                        resultsHtml += `
                        <li class="list-group-item clickable row" id="siswaSearch${row.id}" onclick="moveToLeft(this)">
                            <div class="col-sm-6"><span class="nisn">${row.nisn}</span></div> 
                            <div class="col-sm-6"><span class="nama">${row.nama_lengkap}</span></div>
                        </li>`;
                    });
                    $('#searchResultsSiswa').html(resultsHtml).show();
                } else {
                    $('#searchResultsSiswa').html(`
                    <li class="list-group-item text-muted no-results-item">
                        <p class="no-results-text">Data siswa tidak ditemukan</p>
                    </li>
                `).show();
                }
            },
            error: function() {
                $('#searchResultsSiswa').html(`
                <li class="list-group-item text-danger">
                    Terjadi kesalahan saat memuat data siswa.
                </li>
            `).show();
            }
        });
    }

    // Fungsi untuk memindahkan siswa dari pencarian (search) ke kolom kiri
    function moveToLeftFromSearch(siswaItem) {
        var leftList = document.getElementById('listSiswa');
        siswaItem.remove(); // Hapus dari dropdown pencarian
        leftList.appendChild(siswaItem); // Tambahkan ke kolom sebelah kiri (Siswa Kelas Sebelumnya)
        siswaItem.setAttribute('onclick', 'moveToRight(this)'); // Ubah fungsi click menjadi pindah ke kanan
    }

    // Fungsi untuk memindahkan siswa dari "Table Siswa Kelas" ke kolom sebelah kiri (Siswa Kelas Sebelumnya)
    function moveToLeft(siswaItem) {
        var leftList = document.getElementById('listSiswaSebelah');
        siswaItem.remove(); // Hanya pindahkan ke kolom sebelah kiri, tidak dihapus
        leftList.appendChild(siswaItem); // Tambahkan ke kolom sebelah kiri
        siswaItem.setAttribute('onclick', 'moveToRight(this)'); // Ubah fungsi click menjadi pindah ke kanan
    }

    // Fungsi untuk memindahkan siswa kembali ke "Table Siswa Kelas" (pindah ke kanan)
    function moveToRight(siswaItem) {
        var rightList = document.getElementById('listSiswa');
        siswaItem.remove(); // Pindahkan ke kolom kanan
        rightList.appendChild(siswaItem); // Tambahkan ke kolom kanan
        siswaItem.setAttribute('onclick', 'moveToLeft(this)'); // Ubah fungsi click menjadi pindah ke kiri
    }

    function siswaKelas() {
        const loadingHtml = `
            <div class="loading-container text-center py-3">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="loading-text mt-2">Memuat data siswa kelas...</p>
            </div>
        `;

        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/kelas-siswa" }}',
            method: 'GET',
            data: {
                'sub_kelas_id': "{{ $id_kelas }}",
                'has_pagination': '0'
            },
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}'
            },
            beforeSend: function() {
                $('#listSiswa').html(loadingHtml).show();
            },
            success: function(response) {
                if (response.data.length > 0) {
                    let resultsHtml = '';
                    response.data.forEach(function(row) {
                        resultsHtml += `
                        <li class="list-group-item clickable row" id="siswa${row.id}" onclick="moveToLeft(this)">
                            <div class="col-sm-6"><span class="nisn">${row.siswa.nisn}</span></div> 
                            <div class="col-sm-6"><span class="nama">${row.siswa.nama_lengkap}</span></div>
                        </li>`;
                    });
                    $('#listSiswa').html(resultsHtml).show();
                } else {
                    $('#listSiswa').html(`
                        <li class="list-group-item text-muted no-results-item">
                            <div class="no-results-content text-center">
                                <img src="https://via.placeholder.com/150" alt="No results" class="no-results-img mb-2">
                                <p class="no-results-text">Belum terdapat siswa di dalam kelas ini.</p>
                            </div>
                        </li>
                    `).show();
                }
            },
            error: function() {
                $('#listSiswa').html(`
                    <li class="list-group-item text-danger text-center">
                        Gagal memuat data siswa.
                    </li>
                `).show();
            }
        });
    }
</script>
@endsection