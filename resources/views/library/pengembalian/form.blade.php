@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Kategori -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i>Anggota
                    </h4>
                </div>
                <div class="card-body">
                    <div class="mb-3 position-relative">
                        <input type="text" id="cari_anggota" class="form-control" placeholder="Cari anggota" data-bs-toggle="tooltip" title="Masukkan nama/nisn siswa" />

                        <!-- Dropdown hasil pencarian -->
                        <div id="searchResultsAnggota" class="dropdown-menu" style="width: 100%; display: none;"></div>
                    </div>

                    <!-- Tampilan Kartu Anggota -->
                    <div id="anggotaCard" class="mt-3" style="display: none;">
                        <div class="card" style="width: 100%; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex align-items-center" style="padding: 20px;">

                                <!-- Foto Anggota (di sebelah kiri) -->
                                <div style="margin-right: 40px;">
                                    <img id="anggotaFoto" src="https://via.placeholder.com/100" alt="Foto Anggota" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f1f1f1;">
                                </div>

                                <!-- Informasi Anggota (di sebelah kanan) -->
                                <div>
                                    <h5 class="card-title" id="anggotaNama" style="font-size: 18px; font-weight: bold; color: #333;"></h5>
                                    <p class="card-text" id="anggotaNisn" style="font-size: 14px; color: #777;">NISN: <span class="text-primary" id="nisnText"></span></p>
                                    <p class="card-text" id="anggotaId" style="font-size: 14px; color: #777;">ID Anggota: <span class="text-primary" id="idAnggotaText"></span></p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> {{ $nama_menu2 }}
                    </h4>
                </div>
                <div class="card-body">
                    <form action="">
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="metode">Metode <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="metode" name="metode" class="form-control select2" required>
                                    <option value="">Pilih Metode Peminjaman</option>
                                    <option value="Online">Online</option>
                                    <option value="Offline">Offline</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_kembali">Tanggal Kembali <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="tanggal_kembali" name="tanggal_kembali" class="form-control" placeholder="Masukkan tanggal kembali" value="{{ old('tanggal_kembali') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary w-100">Batal</button>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary w-100">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> List Buku
                    </h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3" hidden>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" placeholder="Cari buku"
                                data-bs-toggle="tooltip" title="Masukkan kode unik buku" />
                        </div>
                        <div class="col-sm-3">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary" data-bs-toggle="tooltip" title="Klik untuk mencari buku">
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 position-relative">
                        <input type="text" id="cari_buku" class="form-control" placeholder="Cari buku" data-bs-toggle="tooltip" title="Masukkan judul/kode unik buku" />

                        <!-- Dropdown hasil pencarian -->
                        <div id="searchResults" class="dropdown-menu" style="width: 100%; display: none;"></div>
                    </div>

                    <!-- Tabel untuk menampilkan buku yang dipilih -->
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tabelBuku">
                            <!-- Baris data buku akan ditambahkan di sini -->
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // Tangani event keyup pada input
        $('#cari_buku').on('keyup', function() {
            var query = $(this).val(); // Ambil nilai input

            // Jika input kosong, tidak melakukan pencarian dan menutup dropdown
            if (query.length < 1) {
                $('#searchResults').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
                return;
            }

            // Data dummy untuk simulasi pencarian buku berdasarkan kode unik
            var dummyData = [{
                    id: "B123",
                    judul: "Pemrograman JavaScript untuk Pemula"
                },
                {
                    id: "B124",
                    judul: "Belajar React.js secara Mendalam"
                },
                {
                    id: "B125",
                    judul: "Dasar-Dasar HTML dan CSS"
                },
                {
                    id: "B126",
                    judul: "Pengantar Python untuk Data Science"
                },
                {
                    id: "B127",
                    judul: "Praktikum Node.js untuk Backend"
                }
            ];

            // Mengambil daftar ID buku yang sudah dipilih dari tabel
            var selectedIds = [];
            $('#tabelBuku tr').each(function() {
                var idBuku = $(this).find('td:eq(1)').text(); // Ambil ID dari kolom kedua tabel
                selectedIds.push(idBuku);
            });

            // Simulasi pencarian berdasarkan kode unik (ID buku) atau judul buku
            var results = dummyData.filter(function(buku) {
                // Pastikan buku yang sudah dipilih tidak muncul lagi di dropdown
                return (buku.id.toLowerCase().includes(query.toLowerCase()) || buku.judul.toLowerCase().includes(query.toLowerCase())) && !selectedIds.includes(buku.id);
            });

            // Jika ada hasil pencarian
            if (results.length > 0) {
                var resultsHtml = '';

                // Loop melalui hasil pencarian dan buat elemen dropdown
                results.forEach(function(buku) {
                    resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectResult(\'' + buku.id + '\', \'' + buku.judul + '\')">' + buku.id + ' - ' + buku.judul + '</a>';
                });

                // Menampilkan hasil pencarian di dropdown
                $('#searchResults').html(resultsHtml).show();
            } else {
                // Jika tidak ada hasil, sembunyikan dropdown
                $('#searchResults').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
            }
        });

        // Tangani event keyup pada input
        // $('#cari_buku').on('keyup', function() {
        //     var query = $(this).val(); // Ambil nilai input

        //     // Jika input kosong, tidak melakukan AJAX dan menutup dropdown
        //     if (query.length < 3) {
        //         $('#searchResults').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
        //         return;
        //     }

        //     // Kirim AJAX untuk mencari buku
        //     $.ajax({
        //         url: '/search/buku', // Ganti dengan URL endpoint pencarian buku Anda
        //         type: 'GET',
        //         data: {
        //             query: query, // Kirimkan query pencarian ke server
        //         },
        //         success: function(response) {
        //             // Jika ada hasil pencarian
        //             if (response.length > 0) {
        //                 var resultsHtml = '';

        //                 // Loop melalui hasil pencarian dan buat elemen dropdown
        //                 response.forEach(function(buku) {
        //                     resultsHtml += '<a href="#" class="dropdown-item" onclick="selectResult(\'' + buku.id + '\', \'' + buku.judul + '\')">' + buku.judul + '</a>';
        //                 });

        //                 // Menampilkan hasil pencarian di dropdown
        //                 $('#searchResults').html(resultsHtml).show();
        //             } else {
        //                 // Jika tidak ada hasil, sembunyikan dropdown
        //                 $('#searchResults').html('<a href="#" class="dropdown-item">No results found</a>').show();
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.log('Terjadi kesalahan:', error);
        //             $('#searchResults').html('Terjadi kesalahan saat pencarian.').show();
        //         }
        //     });
        // });
    });

    // Fungsi untuk memilih hasil dari dropdown
    // function selectResult(id, title) {
    //     // Masukkan nilai judul ke input dan sembunyikan dropdown
    //     $('#cari_buku').val(title);
    //     $('#searchResults').hide();

    //     // Anda dapat melakukan aksi lain, misalnya menyimpan ID atau melakukan AJAX untuk memilih buku
    //     console.log('Selected Book ID:', id);
    // }

    // Fungsi untuk menangani pemilihan hasil dan menambahkannya ke tabel
    function selectResult(id, judul) {
        console.log("Buku dipilih: " + judul + " (ID: " + id + ")");

        // Menambahkan baris baru ke tabel
        var newRow = '<tr>';
        newRow += '<td></td>'; // Tempat untuk nomor urut
        newRow += '<td>' + id + '</td>';
        newRow += '<td>' + judul + '</td>';
        newRow += '<td><button class="btn btn-danger" onclick="removeRow(this, \'' + id + '\')">Hapus</button></td>';
        newRow += '</tr>';

        // Menambahkan baris ke tbody tabel
        $('#tabelBuku').append(newRow);

        // Update nomor urut
        updateRowNumbers();

        // Isi input dengan judul buku yang dipilih
        $('#cari_buku').val('');
        $('#searchResults').html('').hide(); // Menutup dropdown
    }

    // Fungsi untuk menghapus baris pada tabel
    function removeRow(button) {
        $(button).closest('tr').remove();

        // Update nomor urut setelah baris dihapus
        updateRowNumbers();
    }

    // Fungsi untuk memperbarui nomor urut setiap kali baris ditambahkan atau dihapus
    function updateRowNumbers() {
        $('#tabelBuku tr').each(function(index) {
            // Update nomor urut (index + 1 untuk mulai dari 1)
            $(this).find('td:first').text(index + 1);
        });
    }


    // Array untuk menyimpan ID anggota yang sudah dipilih
    var selectedAnggotaIds = [];

    // Tangani event keyup pada input
    $('#cari_anggota').on('keyup', function() {
        var query = $(this).val(); // Ambil nilai input

        // Jika input kosong, tidak melakukan pencarian dan menutup dropdown
        if (query.length < 1) {
            $('#searchResultsAnggota').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
            return;
        }

        // Data dummy untuk simulasi pencarian anggota berdasarkan nama atau nisn
        var dummyDataAnggota = [{
                id: "A123",
                nama: "John Doe",
                nisn: "123456",
                foto: "https://via.placeholder.com/100?text=John",
                nisn: "123456"
            },
            {
                id: "A124",
                nama: "Jane Smith",
                nisn: "123457",
                foto: "https://via.placeholder.com/100?text=Jane",
                nisn: "123457"
            },
            {
                id: "A125",
                nama: "Robert Brown",
                nisn: "123458",
                foto: "https://via.placeholder.com/100?text=Robert",
                nisn: "123458"
            },
            {
                id: "A126",
                nama: "Emily White",
                nisn: "123459",
                foto: "https://via.placeholder.com/100?text=Emily",
                nisn: "123459"
            },
            {
                id: "A127",
                nama: "Daniel Green",
                nisn: "123460",
                foto: "https://via.placeholder.com/100?text=Daniel",
                nisn: "123460"
            }
        ];

        // Simulasi pencarian berdasarkan ID, nama atau nisn anggota
        var results = dummyDataAnggota.filter(function(anggota) {
            return (anggota.id.toLowerCase().includes(query.toLowerCase()) || anggota.nama.toLowerCase().includes(query.toLowerCase()) || anggota.nisn.includes(query)) && !selectedAnggotaIds.includes(anggota.id);
        });

        // Jika ada hasil pencarian
        if (results.length > 0) {
            var resultsHtml = '';

            // Loop melalui hasil pencarian dan buat elemen dropdown
            results.forEach(function(anggota) {
                resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectAnggotaResult(\'' + anggota.id + '\', \'' + anggota.nama + '\', \'' + anggota.nisn + '\')">' + anggota.nisn + ' - ' + anggota.nama + '</a>';
            });

            // Menampilkan hasil pencarian di dropdown
            $('#searchResultsAnggota').html(resultsHtml).show();
        } else {
            // Jika tidak ada hasil, sembunyikan dropdown
            $('#searchResultsAnggota').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
        }
    });

    // Fungsi untuk menangani pemilihan hasil dan menampilkannya sebagai kartu
    function selectAnggotaResult(id, nama, nisn, foto) {
        console.log("Anggota dipilih: " + nama + " (ID: " + id + ", NISN: " + nisn + ")");

        // Pastikan ID anggota tidak sudah ada di kartu
        if (!selectedAnggotaIds.includes(id)) {
            // Menambahkan ID ke dalam selectedAnggotaIds
            selectedAnggotaIds.push(id);

            // Menampilkan foto dan data anggota yang dipilih dalam kartu
            $('#anggotaFoto').attr('src', foto); // Set Foto Anggota
            $('#anggotaNama').text(nama); // Set Nama Anggota
            $('#anggotaNisn').text("NISN: " + nisn); // Set NISN
            $('#anggotaId').text("ID Anggota: " + id); // Set ID Anggota

            // Menampilkan kartu anggota
            $('#anggotaCard').show();

            // Kosongkan input dan sembunyikan dropdown
            $('#cari_anggota').val('');
            $('#searchResultsAnggota').html('').hide();
        }
    }
</script>
@endsection