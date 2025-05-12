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
                    <form action="{{ route('actionAddPerpusPeminjaman') }}" method="POST" id="formSubmit">
                        @csrf
                        <input readonly hidden class="form-control" name="id_anggota" id="id_anggota">
                        <input readonly hidden class="form-control" name="type_anggota" id="type_anggota">
                        <input readonly hidden class="form-control" name="id_buku" id="id_buku">

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="petugas">Petugas</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $user['name'] }}" name="petugas" id="petugas" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="metode">Metode</label>
                            <div class="col-md-9">
                                <input class="form-control" value="Offline" name="metode" id="metode" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_pinjam">Tanggal Pinjam</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $tgl_pinjam }}" name="tanggal_pinjam" id="tanggal_pinjam" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_kembali">Tanggal Kembali</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $tgl_kembali }}" name="tanggal_kembali" id="tanggal_kembali" readonly>
                                <small class="form-text text-muted">Tanggal kembali buku 7 hari setelah tanggal peminjaman.</small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary w-100">Batal</button>
                            </div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary w-100" id="submitButton">Simpan</button>
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
                            <input type="text" class="form-control" placeholder="Cari buku" data-bs-toggle="tooltip" title="Masukkan kode unik buku" />
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
                        <input type="text" id="cari_buku" class="form-control" placeholder="Cari buku" data-bs-toggle="tooltip" title="Masukkan kode unik buku" />

                        <!-- Dropdown hasil pencarian -->
                        <div id="searchResults" class="dropdown-menu" style="width: 100%; display: none; max-height: 300px; overflow-y: scroll; scroll-behavior: smooth;"></div>
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
    // Array untuk menyimpan ID buku yang dipilih
    var selectedBookIds = [];
    var selectedAnggotaIds = [];

    $(document).ready(function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = Array.from(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });

        var submitButton = document.getElementById('submitButton');
        submitButton.disabled = false;
        submitButton.textContent = 'Simpan';

        // Menangani tombol "Simpan" untuk menghindari klik ganda
        document.getElementById('formSubmit').addEventListener('submit', function(event) {
            // Menonaktifkan tombol dan mengubah teks menjadi "Sedang memproses..."
            submitButton.disabled = true;
            submitButton.textContent = 'Sedang memproses...';
        });

        // Tangani event keyup pada input
        $('#cari_buku').on('keyup', function() {
            var query = $(this).val(); // Ambil nilai input

            // Jika input kosong, tidak melakukan pencarian dan menutup dropdown
            if (query.length < 1) {
                $('#searchResults').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
                return;
            }

            // Mengambil daftar ID buku yang sudah dipilih dari tabel
            var selectedIds = [];
            $('#tabelBuku tr').each(function() {
                var idBuku = $(this).find('td:eq(1)').text(); // Ambil ID dari kolom kedua tabel
                selectedIds.push(idBuku);
            });

            // Mengirimkan request ke API untuk mendapatkan data buku yang sesuai dengan query
            $.ajax({
                url: '{{ env("API_URL") . "/api/perpustakaan/buku" }}', // API URL diambil dari .env
                method: 'GET',
                data: {
                    search: query
                },
                headers: {
                    'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
                },
                success: function(response) {
                    // Misalnya, API mengembalikan array buku
                    var results = response.data.items.filter(function(buku) {
                        // Pastikan buku yang sudah dipilih tidak muncul lagi di dropdown
                        return !selectedIds.includes(buku.kode_buku);
                    });

                    // Jika ada hasil pencarian
                    if (results.length > 0) {
                        var resultsHtml = '';

                        // Loop melalui hasil pencarian dan buat elemen dropdown
                        results.forEach(function(buku) {
                            buku.items.forEach(function(bukuItem) {
                                console.log(bukuItem.id);

                                resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectResult(\'' + bukuItem.id + '\', \'' + bukuItem.kode_item + '\', \'' + buku.judul + '\')">' + bukuItem.kode_item + ' | ' + buku.judul + '</a>';
                            });
                        });

                        // Menampilkan hasil pencarian di dropdown
                        $('#searchResults').html(resultsHtml).show();
                    } else {
                        // Jika tidak ada hasil, sembunyikan dropdown
                        $('#searchResults').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
                    }
                },
                error: function() {
                    // Menangani jika terjadi error pada saat request
                    $('#searchResults').html('<a href="javascript:void(0)" class="dropdown-item">Terjadi kesalahan, coba lagi</a>').show();
                }
            });
        });

        // Tangani event keyup pada input anggota
        $('#cari_anggota').on('keyup', function() {
            var query = $(this).val(); // Ambil nilai input

            // Jika input kosong, tidak melakukan pencarian dan menutup dropdown
            if (query.length < 0 || query.length == 0) {
                $('#searchResultsAnggota').html('').hide(); // Kosongkan hasil pencarian dan sembunyikan dropdown
                return;
            }

            // Mengirimkan request ke API untuk mencari anggota berdasarkan query
            $.ajax({
                url: '{{ env("API_URL") . "/api/perpustakaan/anggota" }}', // Ganti dengan URL API yang sesuai
                method: 'GET',
                data: {
                    search: query
                },
                headers: {
                    'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
                },
                success: function(response) {
                    // Misalnya, API mengembalikan array anggota
                    var results = response.data.items.filter(function(anggota) {
                        // Periksa apakah nama pengguna ada dan tidak null atau kosong
                        if (anggota.pengguna && anggota.pengguna.nama && anggota.is_anggota_perpus) {
                            // Menyaring hasil pencarian jika sudah ada anggota yang dipilih
                            return !selectedAnggotaIds.includes(anggota.nama);
                        }
                        return false; // Jika nama pengguna tidak valid (null atau kosong), anggota tidak dimasukkan
                    });
                    console.log(results);


                    // Jika ada hasil pencarian
                    if (results.length > 0) {
                        var resultsHtml = '';

                        // Loop melalui hasil pencarian dan buat elemen dropdown
                        results.forEach(function(anggota) {
                            resultsHtml += '<a href="javascript:void(0)" class="dropdown-item" onclick="selectAnggotaResult(\'' + anggota.id + '\', \'' + anggota.pengguna_type + '\', \'' + anggota.pengguna.nama + '\', \'' + anggota.pengguna.nama + '\')">' + anggota.pengguna.nama + '</a>';
                        });

                        // Menampilkan hasil pencarian di dropdown
                        $('#searchResultsAnggota').html(resultsHtml).show();
                    } else {
                        // Jika tidak ada hasil, sembunyikan dropdown
                        $('#searchResultsAnggota').html('<a href="javascript:void(0)" class="dropdown-item">Tidak ada hasil yang ditemukan</a>').show();
                    }
                },
                error: function() {
                    // Menangani jika terjadi error pada saat request
                    $('#searchResultsAnggota').html('<a href="javascript:void(0)" class="dropdown-item">Terjadi kesalahan, coba lagi</a>').show();
                }
            });
        });
    });

    function selectResult(id, kode, judul) {
        // Menambahkan ID buku ke dalam array selectedBookIds
        if (!selectedBookIds.includes(id)) {
            selectedBookIds.push(id); // Menambahkan ID buku jika belum ada di array
        }

        // Menambahkan baris baru ke tabel
        var newRow = '<tr>';
        newRow += '<td></td>'; // Tempat untuk nomor urut
        newRow += '<td>' + kode + '</td>';
        newRow += '<td>' + judul + '</td>';
        newRow += '<td><button class="btn btn-danger" onclick="removeRow(this, \'' + id + '\')">Hapus</button></td>';
        newRow += '</tr>';

        // Menambahkan baris ke tbody tabel
        $('#tabelBuku').append(newRow);

        // Update nomor urut
        updateRowNumbers();

        // Perbarui nilai input hidden dengan array ID buku yang dipilih
        $('#id_buku').val(selectedBookIds.join(',')); // ID buku dipisahkan oleh koma

        // Isi input dengan judul buku yang dipilih
        $('#cari_buku').val('');
        $('#searchResults').html('').hide(); // Menutup dropdown
    }

    // Fungsi untuk menghapus baris
    function removeRow(button, id) {
        // Menghapus ID buku yang sesuai dari array
        var index = selectedBookIds.indexOf(id);
        if (index !== -1) {
            selectedBookIds.splice(index, 1); // Menghapus ID buku dari array
        }

        // Menghapus baris dari tabel
        $(button).closest('tr').remove();

        // Update nomor urut
        updateRowNumbers();

        // Perbarui input hidden setelah penghapusan
        $('#id_buku').val(selectedBookIds.join(','));
    }

    // Fungsi untuk mengupdate nomor urut pada tabel
    function updateRowNumbers() {
        $('#tabelBuku tr').each(function(index) {
            // Nomor urut dimulai dari 1 (index + 1)
            $(this).find('td:first').text(index + 1);
        });
    }

    // Fungsi untuk menangani pemilihan hasil dan menampilkannya sebagai kartu
    function selectAnggotaResult(id, pengguna_type, nama, nisn, foto) {
        // Pastikan ID anggota tidak sudah ada di kartu
        if (!selectedAnggotaIds.includes(id)) {
            // Menambahkan ID ke dalam selectedAnggotaIds
            selectedAnggotaIds.push(nama);

            // Menampilkan foto dan data anggota yang dipilih dalam kartu
            $('#anggotaFoto').attr('src', foto); // Set Foto Anggota
            $('#anggotaNama').text(nama); // Set Nama Anggota
            $('#anggotaNisn').text("NISN: " + nisn); // Set NISN
            $('#anggotaId').text("ID Anggota: " + id); // Set ID Anggota

            // Menampilkan kartu anggota
            $('#anggotaCard').show();

            // Menyimpan ID anggota yang dipilih ke input hidden (readonly input)
            $('#id_anggota').val(id); // Mengisi input dengan ID anggota yang dipilih
            $('#type_anggota').val(pengguna_type); // Mengisi input dengan ID anggota yang dipilih

            // Kosongkan input dan sembunyikan dropdown
            $('#cari_anggota').val('');
            $('#searchResultsAnggota').html('').hide();
        }
    }
</script>
@endsection