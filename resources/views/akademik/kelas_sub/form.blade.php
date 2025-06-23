@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
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
                    <form action="{{ $action }}" method="POST" id="formSubmit">
                        @csrf
                        @if($method == 'PUT')
                        @method('PUT') <!-- Menandakan bahwa ini adalah update -->
                        @endif

                        <div class="row mb-3">
                            <label for="ta" class="col-md-3 col-form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input name="ta" class="form-control" value="{{ old('ta', $data_ta['tahun_ajaran'] ?? '') }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="tahun_ajaran" class="col-md-3 col-form-label">ID Tahun Ajaran <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="tahun_ajaran" name="tahun_ajaran" class="form-control" value="{{ old('tahun_ajaran', $data_ta['id'] ?? '') }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="status_sk" class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="status_sk" name="status_sk" class="form-control" value="{{ old('status_sk', $data_ta['status']['value'] ?? '1') }}" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kelas" class="col-md-3 col-form-label">Kelas <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control select2" data-toggle="select2" id="kelas" name="kelas" required>
                                    <option value="" disabled selected>Pilih kelas</option>
                                    @foreach($list_kelas as $row)
                                    <option value="{{ $row['id'] }}" {{ old('kelas') == $row['id'] ? 'selected' : '' }} {{ $data_row['kelas']['nama'] ?? '' == $row['nama'] ? 'selected' : '' }}>
                                        {{ $row['nama'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jurusan" class="col-md-3 col-form-label">Jurusan <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control select2" data-toggle="select2" id="jurusan" name="jurusan" required>
                                    <option value="" disabled selected>Pilih jurusan</option>
                                    @foreach($list_jurusan as $row)
                                    <option value="{{ $row['id'] }}" {{ old('kelas') == $row['id'] ? 'selected' : '' }} {{ $data_row['kelas'] ?? '' == $row['nama'] ? 'selected' : '' }}>
                                        {{ $row['nama'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama" class="col-md-3 col-form-label">Nama Sub Kelas <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $data_row['nama'] ?? '') }}" placeholder="Masukkan nama sub kelas" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="max_siswa" class="col-md-3 col-form-label">Jumlah Max Siswa <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="max_siswa" name="max_siswa" class="form-control" value="{{ old('max_siswa', $data_row['max_siswa'] ?? '') }}" placeholder="Masukkan jumlah max siswa sub kelas" onkeypress="return hanyaAngka(event, true);" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="wali_kelas" class="col-md-3 col-form-label">Wali Kelas <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select class="form-control select2" data-toggle="select2" id="wali_kelas" name="wali_kelas" required>
                                    <option value="" disabled {{ old('wali_kelas') ? '' : 'selected' }}>Pilih wali kelas</option>
                                    @foreach($list_guru as $row)
                                    <option value="{{ $row['id'] }}"
                                        {{ (old('wali_kelas') == $row['id'] || (isset($data_row['wali_kelas']['nama_lengkap']) && $data_row['wali_kelas']['nama_lengkap'] == $row['nama_lengkap'])) ? 'selected' : '' }}>
                                        {{ $row['nama_lengkap'] }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary" id="submitButton">Simpan</button>
                        </div>
                    </form>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    function previewImage(event) {
        var file = event.target.files[0]; // Ambil file yang diunggah
        if (file) {
            var reader = new FileReader();

            // Ketika file berhasil dibaca, tampilkan gambar di dalam container
            reader.onload = function(e) {
                var imgElement = document.createElement('img'); // Membuat elemen gambar
                imgElement.src = e.target.result; // Menetapkan sumber gambar
                imgElement.classList.add('img-thumbnail'); // Menambahkan kelas untuk styling
                imgElement.style.maxWidth = '200px'; // Opsional: batasi lebar gambar

                // Menampilkan gambar di dalam container
                var previewContainer = document.getElementById('foto-preview-container');
                previewContainer.innerHTML = ''; // Menghapus gambar sebelumnya (jika ada)
                previewContainer.appendChild(imgElement); // Menambahkan gambar baru
            };

            // Membaca file yang diunggah sebagai URL
            reader.readAsDataURL(file);
        }
    }

    // Menangani tombol "Simpan" untuk menghindari klik ganda
    document.getElementById('formSubmit').addEventListener('submit', function(event) {
        var submitButton = document.getElementById('submitButton');

        // Menonaktifkan tombol dan mengubah teks menjadi "Sedang memproses..."
        submitButton.disabled = true;
        submitButton.textContent = 'Sedang memproses...';
    });
</script>
@endsection