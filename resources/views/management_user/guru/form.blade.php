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
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($method == 'PUT')
                        @method('PUT') <!-- Menandakan bahwa ini adalah update -->
                        @endif

                        <!-- Nama Lengkap -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap', $data_row['nama_lengkap'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- NIP -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="nip">NIP <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip', $data_row['nip'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Tempat dan Tanggal Lahir -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tempat_lahir">Tempat, Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="col-md-4">
                                <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $data_row['tempat_lahir'] ?? '') }}" required>
                            </div>
                            <div class="col-md-5">
                                <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data_row['tanggal_lahir'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ (old('jenis_kelamin', $data_row['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="P" {{ (old('jenis_kelamin', $data_row['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                        </div>

                        <!-- Agama -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="agama">Agama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="agama" name="agama" class="form-select" required>
                                    <option value="" disabled>Pilih Agama</option>
                                    <option value="Islam" {{ (old('agama', $data_row['agama'] ?? '') == 'Islam') ? 'selected' : '' }}>Islam</option>
                                    <option value="Kristen" {{ (old('agama', $data_row['agama'] ?? '') == 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                    <option value="Katolik" {{ (old('agama', $data_row['agama'] ?? '') == 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                    <option value="Hindu" {{ (old('agama', $data_row['agama'] ?? '') == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                    <option value="Buddha" {{ (old('agama', $data_row['agama'] ?? '') == 'Buddha') ? 'selected' : '' }}>Buddha</option>
                                    <option value="Khonghucu" {{ (old('agama', $data_row['agama'] ?? '') == 'Khonghucu') ? 'selected' : '' }}>Khonghucu</option>
                                </select>
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat" required>{{ old('alamat', $data_row['alamat'] ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="nomor_telepon">Nomor Telepon <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" value="{{ old('nomor_telepon', $data_row['nomor_telepon'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="email">Email <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $data_row['email'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Status Kepegawaian -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="status_kepegawaian">Status Kepegawaian <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="status_kepegawaian" name="status_kepegawaian" class="form-select" required>
                                    <option value="PNS" {{ (old('status_kepegawaian', $data_row['status_kepegawaian'] ?? '') == 'PNS') ? 'selected' : '' }}>PNS</option>
                                    <option value="Non-PNS" {{ (old('status_kepegawaian', $data_row['status_kepegawaian'] ?? '') == 'Non-PNS') ? 'selected' : '' }}>Non-PNS</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tahun Masuk -->
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tahun_masuk">Tahun Masuk <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ old('tahun_masuk', $data_row['tahun_masuk'] ?? '') }}" required>
                            </div>
                        </div>

                        <!-- Foto Guru -->
                        <div class="row mb-3">
                            <label for="foto_guru" class="col-md-3 col-form-label">Foto Guru</label>
                            <div class="col-md-9">
                                <input type="file" id="foto_guru" name="foto_guru" class="form-control" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <!-- Tempat untuk menampilkan gambar setelah diunggah -->
                                <div id="foto-preview-container">
                                    <!-- Jika foto sudah ada, tampilkan gambar yang sudah ada -->
                                    <?php if (!empty($data_row['foto']['url'])): ?>
                                        <img src="<?= $data_row['foto']['url'] ?>" class="img-thumbnail" style="max-width: 200px;" alt="Foto Siswa">
                                    <?php else: ?>
                                        <p>Tidak ada foto yang diunggah.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Submit</button>
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
</script>
@endsection