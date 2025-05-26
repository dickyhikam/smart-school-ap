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
                        <i class="mdi mdi-account-group me-2"></i> {{ $nama_menu2 }}
                    </h4>
                </div>
                <div class="card-body">
                    <form id="formSubmitMapel">
                        <div class="row mb-3" hidden>
                            <label for="id" class="col-md-3 col-form-label">ID</label>
                            <div class="col-md-9">
                                <input type="text" id="id" name="id" class="form-control" value="{{ old('id', $data_row['id'] ?? '') }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="kode" class="col-md-3 col-form-label">Kode <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="kode" name="kode" class="form-control" value="{{ old('kode', $data_row['kode'] ?? '') }}" placeholder="Masukkan kode mata pelajaran">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $data_row['nama'] ?? '') }}" placeholder="Masukkan nama mata pelajaran" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="keterangan" class="col-md-3 col-form-label">Keterangan</label>
                            <div class="col-md-9">
                                <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan mata pelajaran"><?= isset($data_row['keterangan']) ? htmlspecialchars($data_row['keterangan']) : ''; ?></textarea>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-info" id="submitButton" onclick="btnSubmitMapel();" @if(isset($data_row['id'])) style="display: none;" @endif>
                                Tambah Pengajar
                            </button>

                            <button type="button" class="btn btn-primary" id="submitButtonAll" onclick="btnSubmitAll();" @if(!isset($data_row['id'])) style="display: none;" @endif>
                                Simpan Semua
                            </button>
                        </div>
                    </form>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <div class="row" id="pagePG" style="display: none;">
        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> List Pengajar
                    </h4>
                </div>
                <div class="card-body">
                    <ul id="listPengajar" class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)"></ul>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> List Guru
                    </h4>
                </div>
                <div class="card-body">
                    <ul id="listGuru" class="list-group" ondrop="drop(event)" ondragover="allowDrop(event)"></ul>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
    </div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    // Menangani tombol "Simpan" untuk menghindari klik ganda
    // document.getElementById('formSubmit').addEventListener('submit', function(event) {
    //     var submitButton = document.getElementById('submitButton');

    //     // Menonaktifkan tombol dan mengubah teks menjadi "Sedang memproses..."
    //     submitButton.disabled = true;
    //     submitButton.textContent = 'Sedang memproses...';
    // });

    var data_pengajar = [];
    $(document).ready(function() {
        @if($id_mapel != null)
        $('#pagePG').show();
        listPengajar();
        @endif
    });

    // Fungsi untuk menangani pengiriman form dengan AJAX
    function btnSubmitMapel() {
        // Define the buttons
        var submitButton = document.getElementById('submitButton'); // 'Tambah Pengajar'
        var submitButtonAll = document.getElementById('submitButtonAll'); // 'Simpan Semua'
        var nama = document.getElementById('nama').value;
        var keterangan = document.getElementById('keterangan').value;

        // Menonaktifkan tombol submit dan mengubah teks menjadi "Sedang memproses..."
        submitButton.disabled = true;
        submitButton.textContent = 'Sedang memproses...';

        // Menyiapkan data yang akan dikirim
        var formData = {
            nama: nama,
            keterangan: keterangan
        };

        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/mapel" }}', // URL API untuk pengiriman data
            type: 'POST',
            data: formData,
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Handle success and show the notification alert
                    notif_alert(response.status, response.message);

                    $('#id').val(response.data.id);
                    $('#kode').val(response.data.kode);

                    $('#pagePG').show();
                    listPengajar();

                    // Menyembunyikan tombol 'Tambah Pengajar' dan menampilkan tombol 'Simpan Semua'
                    submitButton.style.display = 'none'; // Menyembunyikan tombol 'Tambah Pengajar'
                    submitButtonAll.style.display = 'inline-block'; // Menampilkan tombol 'Simpan Semua'
                } else {
                    // Handle failure and show the notification alert
                    notif_alert(response.status, response.message);
                }

                // Mengaktifkan kembali tombol submit setelah pengiriman selesai
                submitButton.disabled = false;
                submitButton.textContent = 'Tambah Pengajar';
            },
            error: function(xhr, status, error) {
                // Check if the response is in JSON format
                if (xhr.responseJSON) {
                    // Extract the message from the JSON response
                    var errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan saat menyimpan data.'; // Fallback message
                    var errorStatus = xhr.responseJSON.status || 'Error'; // Fallback to 'Error' if no status provided

                    // Show an alert with the error message from the JSON response
                    notif_alert(errorStatus, errorMessage); // Assuming you have a function to show the alert
                } else {
                    // If the error isn't JSON, just show a generic alert
                    alert('Error: ' + error);
                }

                // Mengaktifkan kembali tombol submit setelah pengiriman selesai
                submitButton.disabled = false;
                submitButton.textContent = 'Tambah Pengajar';
            }
        });
    }

    function btnSubmitAll() {
        var submitButtonAll = document.getElementById('submitButtonAll'); // 'Simpan Semua'
        var nama = document.getElementById('nama').value;
        var keterangan = document.getElementById('keterangan').value;
        var id_mapel = document.getElementById('id').value;

        // Menonaktifkan tombol submit dan mengubah teks menjadi "Sedang memproses..."
        submitButtonAll.disabled = true;
        submitButtonAll.textContent = 'Sedang memproses...';

        // Menyiapkan data yang akan dikirim
        var formData = {
            nama: nama,
            keterangan: keterangan
        };

        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/mapel/"  }}' + id_mapel, // Ganti dengan URL API yang sesuai
            method: 'PUT',
            data: formData,
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                if (response.status === 'success') {
                    // Handle success and show the notification alert
                    notif_alert(response.status, response.message);

                    //Add an event listener to the "Tutup" button
                    $('#alert-modal2 .btn-info').on('click', function() {
                        window.location.href = " {{ route('pageMapel') }}";
                    });
                } else {
                    // Handle failure and show the notification alert
                    notif_alert(response.status, response.message);
                }

                // Mengaktifkan kembali tombol submit setelah pengiriman selesai
                submitButtonAll.disabled = false;
                submitButtonAll.textContent = 'Simpan Semua';
            },
            error: function(xhr, status, error) {
                // Check if the response is in JSON format
                if (xhr.responseJSON) {
                    // Extract the message from the JSON response
                    var errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan saat menyimpan data.'; // Fallback message
                    var errorStatus = xhr.responseJSON.status || 'Error'; // Fallback to 'Error' if no status provided

                    // Show an alert with the error message from the JSON response
                    notif_alert(errorStatus, errorMessage); // Assuming you have a function to show the alert
                } else {
                    // If the error isn't JSON, just show a generic alert
                    alert('Error: ' + error);
                }

                // Mengaktifkan kembali tombol submit setelah pengiriman selesai
                submitButtonAll.disabled = false;
                submitButtonAll.textContent = 'Simpan Semua';
            }
        });
    }

    function listPengajar() {
        // Show loading indicator
        $('#listPengajar').html('<div class="loading-container"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="loading-text">Memuat data pengajar...</p></div>').show();
        // Show loading indicator
        $('#listGuru').html('<div class="loading-container"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="loading-text">Memuat data guru...</p></div>').show();

        var id_mapel = document.getElementById('id').value;
        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/mapel/"  }}' + id_mapel, // Ganti dengan URL API yang sesuai
            method: 'GET',
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                $('#listPengajar').html('');
                // Jika ada hasil pencarian
                if (response.data.pengajar.length > 0) {
                    var resultsHtml = '';
                    response.data.pengajar.forEach(function(row) {
                        resultsHtml += `<li class="list-group-item clickable row" id="${row.id}" onclick="movePengajar(this)">
                                            <div class="col-sm-6"><span class="nisn">${row.nip}</span></div>
                                            <div class="col-sm-6"><span class="nama">${row.nama}</span></div>
                                        </li>`;
                    });
                    $('#listPengajar').html(resultsHtml).show();
                    data_pengajar = response.data.pengajar;
                    console.log(data_pengajar);

                } else {
                    // Jika tidak ada siswa kelas
                    $('#listPengajar').html(`<li class="list-group-item text-muted no-results-item">
                                            <div class="no-results-content">
                                                <img src="https://via.placeholder.com/150" alt="No results" class="no-results-img">
                                                <p class="no-results-text">Belum terdapat pengajar di mata pelajaran ini.</p>
                                            </div>
                                        </li>`).show();
                }
                listGuru();
            },
            error: function() {
                $('#listPengajar').html('').show();
            }
        });
    }

    function listGuru() {
        // Show loading indicator
        $('#listGuru').html('<div class="loading-container"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div><p class="loading-text">Memuat data guru...</p></div>').show();
        $.ajax({
            url: '{{ env("API_URL") . "/api/guru?status=1" }}', // Ganti dengan URL API yang sesuai
            method: 'GET',
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                $('#listGuru').html('');
                // Jika ada hasil pencarian
                if (response.data.items.length > 0) {
                    var resultsHtml = '';
                    response.data.items
                        .filter(function(row) {
                            // Mengecualikan pengajar yang sudah ada di data_pengajar berdasarkan NIP
                            return !data_pengajar.map(function(pengajar) {
                                return pengajar.nip;
                            }).includes(row.nip); // Memastikan NIP yang tidak ada dalam data_pengajar
                        })
                        .forEach(function(row) {
                            resultsHtml += `<li class="list-group-item clickable row" id="${row.id}" onclick="moveGuru(this)">
                            <div class="col-sm-6"><span class="nisn">${row.nip}</span></div>
                            <div class="col-sm-6"><span class="nama">${row.nama_lengkap}</span></div>
                        </li>`;
                        });
                    $('#listGuru').html(resultsHtml).show();
                } else {
                    // Jika tidak ada siswa kelas
                    $('#listGuru').html(`<li class="list-group-item text-muted no-results-item">
                                            <div class="no-results-content">
                                                <img src="https://via.placeholder.com/150" alt="No results" class="no-results-img">
                                                <p class="no-results-text">Belum terdapat siswa di dalam kelas ini.</p>
                                            </div>
                                        </li>`).show();
                }
            },
            error: function() {
                $('#listGuru').html('').show();
            }
        });
    }

    function moveGuru(dataItem) {
        var id = document.getElementById('id').value;
        var guruId = dataItem.id;

        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/mapel-pengajar" }}', // Ganti dengan URL API yang sesuai
            method: 'POST',
            data: {
                pengajar_id: guruId,
                mapel_ids: [id],
                status: 1
            },
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                // Handle success and show the notification alert
                notif_alert(response.status, response.message);
                listPengajar();
            },
            error: function(xhr, status, error) {
                // Check if the response is in JSON format
                if (xhr.responseJSON) {
                    // Extract the message from the JSON response
                    var errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan saat menyimpan data.'; // Fallback message
                    var errorStatus = xhr.responseJSON.status || 'Error'; // Fallback to 'Error' if no status provided

                    // Show an alert with the error message from the JSON response
                    notif_alert(errorStatus, errorMessage); // Assuming you have a function to show the alert
                } else {
                    // If the error isn't JSON, just show a generic alert
                    alert('Error: ' + error);
                }
            }
        });
    }

    function movePengajar(dataItem) {
        // Mendapatkan ID dari elemen yang diklik
        var dataId = dataItem.id;
        $.ajax({
            url: '{{ env("API_URL") . "/api/akademik/mapel-pengajar/" }}' + dataId, // Ganti dengan URL API yang sesuai
            method: 'DELETE',
            headers: {
                'Authorization': 'Bearer {{ $apiToken }}' // Menambahkan token dalam header Authorization
            },
            success: function(response) {
                // Handle success and show the notification alert
                notif_alert(response.status, response.message);
                listPengajar();
            },
            error: function(xhr, status, error) {
                // Check if the response is in JSON format
                if (xhr.responseJSON) {
                    // Extract the message from the JSON response
                    var errorMessage = xhr.responseJSON.message || 'Terjadi kesalahan saat menyimpan data.'; // Fallback message
                    var errorStatus = xhr.responseJSON.status || 'Error'; // Fallback to 'Error' if no status provided

                    // Show an alert with the error message from the JSON response
                    notif_alert(errorStatus, errorMessage); // Assuming you have a function to show the alert

                    listPengajar();
                } else {
                    // If the error isn't JSON, just show a generic alert
                    alert('Error: ' + error);
                }
            }
        });
    }

    function notif_alert(status, message) {
        var alertType, alertIcon, alertTitle;

        // Determine alert type based on response
        if (status === 'success') {
            alertType = 'success';
            alertIcon = `<svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <g fill="none" stroke="currentColor" stroke-width="1.5">
                                <circle cx="12" cy="12" r="10" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                            </g>
                        </svg>`;
            alertTitle = 'Berhasil';
        } else {
            alertType = 'error';
            alertIcon = `<svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M10.03 8.97a.75.75 0 0 0-1.06 1.06L10.94 12l-1.97 1.97a.75.75 0 1 0 1.06 1.06L12 13.06l1.97 1.97a.75.75 0 0 0 1.06-1.06L13.06 12l1.97-1.97a.75.75 0 1 0-1.06-1.06L12 10.94z" />
                            <path fill="currentColor" fill-rule="evenodd" d="M12.057 1.25h-.114c-2.309 0-4.118 0-5.53.19c-1.444.194-2.584.6-3.479 1.494c-.895.895-1.3 2.035-1.494 3.48c-.19 1.411-.19 3.22-.19 5.529v.114c0 2.309 0 4.118.19 5.53c.194 1.444.6 2.584 1.494 3.479c.895.895 2.035 1.3 3.48 1.494c1.411.19 3.22.19 5.529.19h.114c2.309 0 4.118 0 5.53-.19c1.444-.194 2.584-.6 3.479-1.494c.895-.895 1.3-2.035 1.494-3.48c.19-1.411.19-3.22.19-5.529v-.114c0-2.309 0-4.118-.19-5.53c-.194-1.444-.6-2.584-1.494-3.479c-.895-.895-2.035-1.3-3.48-1.494c-1.411-.19-3.22-.19-5.529-.19M3.995 3.995c.57-.57 1.34-.897 2.619-1.069c1.3-.174 3.008-.176 5.386-.176s4.086.002 5.386.176c1.279.172 2.05.5 2.62 1.069c.569.57.896 1.34 1.068 2.619c.174 1.3.176 3.008.176 5.386s-.002 4.086-.176 5.386c-.172 1.279-.5 2.05-1.069 2.62c-.57.569-1.34.896-2.619 1.068c-1.3.174-3.008.176-5.386.176s-4.086-.002-5.386-.176c-1.279-.172-2.05-.5-2.62-1.069c-.569-.57-.896-1.34-1.068-2.619c-.174-1.3-.176-3.008-.176-5.386s.002-4.086.176-5.386c.172-1.279.5-2.05 1.069-2.62" clip-rule="evenodd" />
                        </svg>`;
            alertTitle = 'Gagal';
        }

        // Set the modal content dynamically
        $('#alert-icon2').html(alertIcon);
        $('#alert-title2').text(alertTitle);
        $('#alert-message2').text(message || 'Terjadi kesalahan saat menyimpan data.');
        // Show the modal
        $('#alert-modal2').modal('show');
    }
</script>
@endsection