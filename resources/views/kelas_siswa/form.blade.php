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
                        <div class="col-sm-4">
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-info" id="submitButton">
                                    <i class="bi bi-arrow-left-circle"></i> Tambah Siswa Kelas Random
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="d-grid gap-2 mt-3">
                                <button type="button" class="btn btn-outline-primary" id="submitButton">
                                    <i class="bi bi-arrow-left-circle"></i> Tambah Siswa Kelas Dari Kelas Sebelumnya
                                </button>
                            </div>
                        </div>
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
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Siswa Kelas Sebelumnya
                    </h4>
                </div>
                <div class="card-body">
                    <ul id="listSiswaSebelah" class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)">
                        <li class="list-group-item clickable" id="siswa1" onclick="moveToLeft(this)">
                            <span class="nisn">1001</span> | <span class="nama">Toni</span>
                        </li>
                    </ul>
                </div> <!-- end card body-->
            </div> <!-- end card -->

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
                        <div id="searchResultsSiswa" class="dropdown-menu" style="width: 100%; display: none;"></div>
                    </div>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

    </div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    // siswaKelas();
    // Contoh data siswa (dapat diganti dengan data dari API atau database)
    const siswaData = [{
            nisn: '1001',
            nama: 'Toni'
        },
        {
            nisn: '1002',
            nama: 'Rina'
        },
        {
            nisn: '1003',
            nama: 'Budi'
        },
        {
            nisn: '1004',
            nama: 'Siti'
        }
    ];

    // Fungsi pencarian siswa
    function searchSiswa() {
        const input = document.getElementById('cari_siswa');
        const searchResults = document.getElementById('searchResultsSiswa');
        const searchTerm = input.value.toLowerCase();

        // Filter siswa berdasarkan NISN atau Nama
        const filteredSiswa = siswaData.filter(siswa =>
            siswa.nisn.toLowerCase().includes(searchTerm) || siswa.nama.toLowerCase().includes(searchTerm)
        );

        // Kosongkan dropdown sebelum menampilkan hasil pencarian
        searchResults.innerHTML = '';

        if (filteredSiswa.length > 0) {
            // Tampilkan hasil pencarian dalam format list
            filteredSiswa.forEach(siswa => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'clickable');
                listItem.setAttribute('onclick', 'moveToLeftFromSearch(this)');

                listItem.innerHTML = `<span class="nisn">${siswa.nisn}</span> | <span class="nama">${siswa.nama}</span>`;

                // Tambahkan item ke dalam dropdown
                searchResults.appendChild(listItem);
            });

            // Tampilkan dropdown
            searchResults.style.display = 'block';
        } else {
            // Jika tidak ada hasil, sembunyikan dropdown
            searchResults.style.display = 'none';
        }
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
        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/kelas-siswa" }}', // Ganti dengan URL API yang sesuai
            method: 'GET',
            data: {
                'sub_kelas_id': "{{ $id_kelas }}",
            },
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                // Misalnya, API mengembalikan array anggota
                var results = response.data.items.filter(function(row) {
                    // if (row.pengguna && row.pengguna.nama && row.is_anggota_perpus) {
                    //     return !selectedAnggotaIds.includes(row.nama);
                    // }
                    // return false;
                    return row.siswa;
                });
                console.log(results);

                // Jika ada hasil pencarian
                if (results.length > 0) {
                    var resultsHtml = '';
                    results.forEach(function(row) {
                        resultsHtml += `<li class="list-group-item clickable" id="siswa` + row.id + `" onclick="moveToLeft(this)">
                                            <span class="nisn">` + row.siswa.nisn + `</span> | <span class="nama">` + row.siswa.nama_lengkap + `</span>
                                        </li>`;
                    });
                    $('#listSiswa').html(resultsHtml).show();
                } else {
                    // Jika tidak ada siswa kelas
                    $('#listSiswa').html(`<li class="list-group-item text-muted no-results-item">
                                            <div class="no-results-content">
                                                <img src="https://via.placeholder.com/150" alt="No results" class="no-results-img">
                                                <p class="no-results-text">Belum terdapat siswa di dalam kelas ini.</p>
                                            </div>
                                        </li>`).show();
                }
            },
            error: function() {
                $('#listSiswa').html('').show();
            }
        });
    }
</script>

<script>
    // $(document).ready(function() {
    //     // Event listener untuk keyup (ketika mengetik)
    //     $('#cari_siswa').on('keyup', function() {
    //         var query = $(this).val();
    //         searchAnggota(query); // Panggil fungsi pencarian
    //     });

    //     // Event listener untuk click (ketika input diklik)
    //     $('#cari_siswa').on('click', function() {
    //         var query = $(this).val();
    //         searchAnggota(query); // Panggil fungsi pencarian
    //     });

    //     // Event listener untuk blur (ketika input kehilangan fokus)
    //     $('#cari_siswa').on('blur', function() {
    //         handleBlur(); // Panggil fungsi blur
    //     });
    // });

    // // Fungsi untuk menangani pencarian anggota
    // function searchAnggota(query) {
    //     // Mengirimkan request ke API untuk mencari anggota berdasarkan query
    //     $.ajax({
    //         url: '{{ env("API_URL") . "/api/siswa" }}', // Ganti dengan URL API yang sesuai
    //         method: 'GET',
    //         data: {
    //             search: query
    //         },
    //         headers: {
    //             'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
    //         },
    //         success: function(response) {
    //             // Misalnya, API mengembalikan array anggota
    //             var results = response.data.items.filter(function(anggota) {
    //                 if (anggota.pengguna && anggota.pengguna.nama && anggota.is_anggota_perpus) {
    //                     return !selectedAnggotaIds.includes(anggota.nama);
    //                 }
    //                 return false;
    //             });

    //             // Jika ada hasil pencarian
    //             if (results.length > 0) {
    //                 var resultsHtml = '';
    //                 results.forEach(function(anggota) {
    //                     resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectAnggotaResult(\'' + anggota.id + '\', \'' + anggota.pengguna_type + '\', \'' + anggota.pengguna.nama + '\', \'' + anggota.pengguna.nama + '\')">' + anggota.pengguna.nama + '</a>';
    //                 });
    //                 $('#searchResultsSiswa').html(resultsHtml).show();
    //             } else {
    //                 // Jika tidak ada hasil
    //                 $('#searchResultsSiswa').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
    //             }
    //         },
    //         error: function() {
    //             $('#searchResultsSiswa').html('<a href="javascript:void(0)" class="dropdown-item">Terjadi kesalahan, coba lagi</a>').show();
    //         }
    //     });
    // }

    // // Fungsi untuk menangani event blur
    // function handleBlur() {
    //     // Menyembunyikan dropdown hasil pencarian setelah kehilangan fokus
    //     setTimeout(function() {
    //         $('#searchResultsSiswa').hide();
    //     }, 200); // Delay untuk menghindari hilangnya dropdown saat memilih item
    // }
</script>
@endsection