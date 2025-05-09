@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-body pt-0">
                    <form action="{{ $action }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @if($method == 'PUT')
                        @method('PUT') <!-- Menandakan bahwa ini adalah update -->
                        @endif
                        <div id="basicwizard">
                            <ul class="nav nav-pills nav-justified form-wizard-header mb-4">
                                <li class="nav-item">
                                    <a href="#basictab1" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 py-2">
                                        <i class="bi bi-person-circle fs-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">{{ $nama_menu2 }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab5" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 py-2">
                                        <i class="bi bi-person-circle fs-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">{{ $nama_menu6 }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab2" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 py-2">
                                        <i class="bi bi-emoji-smile fs-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">{{ $nama_menu3 }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab3" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 py-2">
                                        <i class="bi bi-check2-circle fs-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">{{ $nama_menu4 }}</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#basictab4" data-bs-toggle="tab" data-toggle="tab"
                                        class="nav-link rounded-0 py-2">
                                        <i class="bi bi-check2-circle fs-18 align-middle me-1"></i>
                                        <span class="d-none d-sm-inline">{{ $nama_menu5 }}</span>
                                    </a>
                                </li>
                            </ul>

                            <div class="tab-content b-0 mb-0">
                                <div class="tab-pane" id="basictab1">
                                    <input type="text" id="id" name="id" value="{{ old('id', $data_row['id'] ?? '') }}" hidden readonly>
                                    <input type="text" id="id_ayah" name="id_ayah" value="{{ old('id_ayah', $data_row_ayah['id'] ?? '') }}" hidden readonly>
                                    <input type="text" id="id_ibu" name="id_ibu" value="{{ old('id_ibu', $data_row_ibu['id'] ?? '') }}" hidden readonly>
                                    <input type="text" id="id_wali" name="id_wali" value="{{ old('id_wali', $data_row_wali['id'] ?? '') }}" hidden readonly>
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- NISN -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="nisn">NISN <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN" value="{{ old('nisn', $data_row['nisn'] ?? '') }}" required>
                                                </div>
                                            </div>

                                            <!-- Nama Lengkap -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap', $data_row['nama_lengkap'] ?? '') }}" required>
                                                </div>
                                            </div>

                                            <!-- Alamat -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="alamat">Alamat <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat" required>{{ old('alamat', $data_row['alamat'] ?? '') }}</textarea>
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

                                            <!-- Tempat/Tanggal Lahir -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="tempat_lahir">Tempat/Tanggal Lahir <span class="text-danger">*</span></label>
                                                <div class="col-md-4">
                                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $data_row['tempat_lahir'] ?? '') }}" required>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <h3>/</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data_row['tanggal_lahir'] ?? '') }}" required>
                                                </div>
                                            </div>

                                            <!-- Status Pendidikan -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="status_pendidikan">Status Pendidikan <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select id="status_pendidikan" name="status_pendidikan" class="form-select" required>
                                                        <option value="Aktif" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                                        <option value="Lulus" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Lulus') ? 'selected' : '' }}>Lulus</option>
                                                        <option value="Pindah" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Pindah') ? 'selected' : '' }}>Pindah</option>
                                                        <option value="Tidak Aktif" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
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

                                            <!-- Tahun Masuk/Tahun Lulus -->
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="tahun_masuk">Tahun Masuk/Tahun Lulus</label>
                                                <div class="col-md-4">
                                                    <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ old('tahun_masuk', $data_row['tahun_masuk'] ?? '') }}" required>
                                                </div>
                                                <div class="col-md-1 d-flex justify-content-center align-items-center">
                                                    <h3>/</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <input type="number" id="tahun_lulus" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus" value="{{ old('tahun_lulus', $data_row['tahun_lulus'] ?? '') }}">
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="golongan_darah">Golongan Darah</label>
                                                <div class="col-md-9">
                                                    <select id="golongan_darah" name="golongan_darah" class="form-select">
                                                        <option value="">Pilih Golongan Darah</option>
                                                        <option value="A" {{ (old('golongan_darah', $data_row['golongan_darah'] ?? '') == 'A') ? 'selected' : '' }}>A</option>
                                                        <option value="B" {{ (old('golongan_darah', $data_row['golongan_darah'] ?? '') == 'B') ? 'selected' : '' }}>B</option>
                                                        <option value="AB" {{ (old('golongan_darah', $data_row['golongan_darah'] ?? '') == 'AB') ? 'selected' : '' }}>AB</option>
                                                        <option value="O" {{ (old('golongan_darah', $data_row['golongan_darah'] ?? '') == 'O') ? 'selected' : '' }}>O</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="basictab5">
                                    <div class="row mb-3">
                                        <label for="foto_siswa" class="col-md-3 col-form-label">Foto Siswa <span class="text-danger">*</span></label>
                                        <div class="col-md-9">
                                            <input type="file" id="foto_siswa" name="foto_siswa" class="form-control" accept="image/*" onchange="previewImage(event)">
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
                                </div>

                                <div class="tab-pane" id="basictab2">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label for="nik_ayah" class="col-md-3 col-form-label">NIK Ayah <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" id="nik_ayah" name="nik_ayah" class="form-control" value="{{ old('nik_ayah', $data_row_ayah['nik'] ?? '') }}" placeholder="NIK Ayah" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-grid gap-2">
                                                        <button type="button" class="btn btn-info" id="searchButtonAyah" onclick="cariDataAyah();">Cari</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="con_ayah" name="con_ayah" class="form-control" value="{{ old('con_ayah', 'new') }}" hidden readonly>

                                            <div class="row mb-3">
                                                <label for="nama_lengkap_ayah" class="col-md-3 col-form-label">Nama Lengkap Ayah <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nama_lengkap_ayah" name="nama_lengkap_ayah" class="form-control" value="{{ old('nama_lengkap_ayah', $data_row_ayah['nama_lengkap'] ?? '') }}" placeholder="Nama Lengkap ayah" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="pekerjaan_ayah" class="col-md-3 col-form-label">Pekerjaan Ayah <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="pekerjaan_ayah" name="pekerjaan_ayah" class="form-control" value="{{ old('pekerjaan_ayah', $data_row_ayah['pekerjaan'] ?? '') }}" placeholder="Pekerjaan ayah" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="alamat" class="col-md-3 col-form-label">Alamat Ayah <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="alamat_ayah" name="alamat_ayah" class="form-control" value="{{ old('alamat_ayah', $data_row_ayah['alamat'] ?? '') }}" placeholder="Alamat ayah" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="nomor_telepon" class="col-md-3 col-form-label">Nomor Telepon Ayah <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nomor_telepon_ayah" name="nomor_telepon_ayah" class="form-control" value="{{ old('nomor_telepon_ayah', $data_row_ayah['nomor_telepon'] ?? '') }}" placeholder="Nomor Telepon ayah" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-3 col-form-label">Email Ayah</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email_ayah" name="email_ayah" class="form-control" value="{{ old('email_ayah', $data_row_ayah['email'] ?? '') }}" placeholder="Email ayah">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="basictab3">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label for="nik_ibu" class="col-md-3 col-form-label">NIK Ibu <span class="text-danger">*</span></label>
                                                <div class="col-md-7">
                                                    <input type="text" id="nik_ibu" name="nik_ibu" class="form-control" value="{{ old('nik_ibu', $data_row_ibu['nik'] ?? '') }}" placeholder="NIK Ibu" required>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="d-grid gap-2">
                                                        <button type="button" class="btn btn-info" id="searchButtonIbu" onclick="cariDataIbu();">Cari</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <input id="con_ibu" name="con_ibu" class="form-control" value="{{ old('con_ibu', 'new') }}" hidden readonly>

                                            <div class="row mb-3">
                                                <label for="nama_lengkap_ibu" class="col-md-3 col-form-label">Nama Lengkap Ibu <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nama_lengkap_ibu" name="nama_lengkap_ibu" class="form-control"
                                                        value="{{ old('nama_lengkap_ibu', $data_row_ibu['nama_lengkap'] ?? '') }}" placeholder="Nama Lengkap ibu" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="pekerjaan_ibu" class="col-md-3 col-form-label">Pekerjaan Ibu <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="pekerjaan_ibu" name="pekerjaan_ibu" class="form-control"
                                                        value="{{ old('pekerjaan_ibu', $data_row_ibu['pekerjaan'] ?? '') }}" placeholder="Pekerjaan ibu" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="alamat_ibu" class="col-md-3 col-form-label">Alamat Ibu <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="alamat_ibu" name="alamat_ibu" class="form-control"
                                                        value="{{ old('alamat_ibu', $data_row_ibu['alamat'] ?? '') }}" placeholder="Alamat ibu" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="nomor_telepon_ibu" class="col-md-3 col-form-label">Nomor Telepon Ibu <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <input type="text" id="nomor_telepon_ibu" name="nomor_telepon_ibu" class="form-control"
                                                        value="{{ old('nomor_telepon_ibu', $data_row_ibu['nomor_telepon'] ?? '') }}" placeholder="Nomor Telepon ibu" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email_ibu" class="col-md-3 col-form-label">Email Ibu</label>
                                                <div class="col-md-9">
                                                    <input type="email" id="email_ibu" name="email_ibu" class="form-control"
                                                        value="{{ old('email_ibu', $data_row_ibu['email'] ?? '') }}" placeholder="Email ibu">
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="tab-pane" id="basictab4">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="row mb-3">
                                                <label class="col-md-3 col-form-label" for="wali">Wali Adalah <span class="text-danger">*</span></label>
                                                <div class="col-md-9">
                                                    <select id="wali" name="wali" class="form-select" onchange="toggleWaliForm()" required>
                                                        <option value="">Pilih Wali</option>
                                                        <option value="Ayah" {{ (old('wali', $data_row_ayah['status_wali'] ?? '' == 'ya') ? 'selected' : '') }}>Ayah</option>
                                                        <option value="Ibu" {{ (old('wali', $data_row_ibu['status_wali'] ?? '' == 'ya') ? 'selected' : '') }}>Ibu</option>
                                                        <option value="Lain-lain" {{ (old('wali', $data_row_wali['jenis_orang_tua'] ?? '' == 'Wali') ? 'selected' : '') }}>Lain-lain</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="wali_form">
                                                <div class="row mb-3">
                                                    <label for="nik_wali" class="col-md-3 col-form-label">NIK Wali <span class="text-danger">*</span></label>
                                                    <div class="col-md-7">
                                                        <input type="text" id="nik_wali" name="nik_wali" class="form-control" value="{{ old('nik_wali', $data_row_wali['nik'] ?? '') }}" placeholder="NIK Wali" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="d-grid gap-2">
                                                            <button type="button" class="btn btn-info" id="searchButtonWali">Cari</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input id="con_wali" name="con_wali" class="form-control" value="{{ old('con_wali', 'new') }}" hidden readonly>

                                                <div class="row mb-3">
                                                    <label for="nama_lengkap_wali" class="col-md-3 col-form-label">Nama Lengkap Wali <span class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="nama_lengkap_wali" name="nama_lengkap_wali" class="form-control"
                                                            value="{{ old('nama_lengkap_wali', $data_row_wali['nama_lengkap'] ?? '') }}" placeholder="Nama Lengkap wali">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="pekerjaan_wali" class="col-md-3 col-form-label">Pekerjaan Wali <span class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="pekerjaan_wali" name="pekerjaan_wali" class="form-control"
                                                            value="{{ old('pekerjaan_wali', $data_row_wali['pekerjaan'] ?? '') }}" placeholder="Pekerjaan wali">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="alamat_wali" class="col-md-3 col-form-label">Alamat Wali <span class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="alamat_wali" name="alamat_wali" class="form-control"
                                                            value="{{ old('alamat_wali', $data_row_wali['alamat'] ?? '') }}" placeholder="Alamat wali">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="nomor_telepon_wali" class="col-md-3 col-form-label">Nomor Telepon Wali <span class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="nomor_telepon_wali" name="nomor_telepon_wali" class="form-control"
                                                            value="{{ old('nomor_telepon_wali', $data_row_wali['nomor_telepon'] ?? '') }}" placeholder="Nomor Telepon wali">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="email_wali" class="col-md-3 col-form-label">Email Wali</label>
                                                    <div class="col-md-9">
                                                        <input type="email" id="email_wali" name="email_wali" class="form-control"
                                                            value="{{ old('email_wali', $data_row_wali['email'] ?? '') }}" placeholder="Email wali">
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <label for="hubungan_wali" class="col-md-3 col-form-label">Hubungan dengan Siswa <span class="text-danger">*</span></label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="hubungan_wali" name="hubungan_wali" class="form-control"
                                                            value="{{ old('hubungan_wali', $data_row_wali['hubungan'] ?? '') }}" placeholder="Hubungan dengan siswa">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end col -->
                                    </div> <!-- end row -->
                                </div>

                                <div class="d-flex wizard justify-content-between flex-wrap gap-2 mt-3">
                                    <div class="first">
                                        <a href="javascript:void(0);" class="btn btn-primary" hidden>
                                            Pertama
                                        </a>
                                    </div>
                                    <div class="d-flex flex-wrap gap-2">
                                        <div class="previous">
                                            <a href="javascript:void(0);" class="btn btn-primary">
                                                Sebelumnya
                                            </a>
                                        </div>
                                        <div class="next">
                                            <a href="javascript:void(0);" class="btn btn-primary mt-3 mt-md-0">
                                                Selanjutnya
                                            </a>
                                        </div>
                                    </div>
                                    <div class="last">
                                        <button type="submit" href="javascript:void(0);" class="btn btn-primary mt-3 mt-md-0">
                                            Simpan
                                        </button>
                                    </div>
                                </div>

                            </div> <!-- tab-content -->

                        </div> <!-- end #basicwizard-->
                    </form>
                </div>
            </div>

            <div class="card shadow-sm" hidden>
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

                        <!-- NISN -->
                        <div class="mb-3">
                            <label for="nisn" class="form-label">NISN <span class="text-danger">*</span></label>
                            <input type="text" id="nisn" name="nisn" class="form-control" placeholder="NISN" value="{{ old('nisn', $data_row['nisn'] ?? '') }}" required>
                        </div>

                        <!-- Nama Lengkap -->
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap', $data_row['nama_lengkap'] ?? '') }}" required>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat" required>{{ old('alamat', $data_row['alamat'] ?? '') }}</textarea>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ (old('jenis_kelamin', $data_row['jenis_kelamin'] ?? '') == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ (old('jenis_kelamin', $data_row['jenis_kelamin'] ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Nomor Telepon -->
                                <div class="mb-3">
                                    <label for="nomor_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                                    <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" value="{{ old('nomor_telepon', $data_row['nomor_telepon'] ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- Email -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $data_row['email'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- Tempat Lahir -->
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $data_row['tempat_lahir'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- Tanggal Lahir -->
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data_row['tanggal_lahir'] ?? '') }}" required>
                                </div>
                            </div>

                            <div class="col-sm-5">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- Status Pendidikan -->
                                        <div class="mb-3">
                                            <label for="status_pendidikan" class="form-label">Status Pendidikan <span class="text-danger">*</span></label>
                                            <select id="status_pendidikan" name="status_pendidikan" class="form-select" required>
                                                <option value="Aktif" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Aktif') ? 'selected' : '' }}>Aktif</option>
                                                <option value="Lulus" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Lulus') ? 'selected' : '' }}>Lulus</option>
                                                <option value="Pindah" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Pindah') ? 'selected' : '' }}>Pindah</option>
                                                <option value="Tidak Aktif" {{ (old('status_pendidikan', $data_row['status_pendidikan'] ?? '') == 'Tidak Aktif') ? 'selected' : '' }}>Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <!-- Agama -->
                                        <div class="mb-3">
                                            <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
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
                                </div>

                            </div>
                            <div class="col-sm-7">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <!-- Tahun Masuk -->
                                        <div class="mb-3">
                                            <label for="tahun_masuk" class="form-label">Tahun Masuk <span class="text-danger">*</span></label>
                                            <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ old('tahun_masuk', $data_row['tahun_masuk'] ?? '') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Tahun Lulus -->
                                        <div class="mb-3">
                                            <label for="tahun_lulus" class="form-label">Tahun Lulus</label>
                                            <input type="number" id="tahun_lulus" name="tahun_lulus" class="form-control" placeholder="Tahun Lulus" value="{{ old('tahun_lulus', $data_row['tahun_lulus'] ?? '') }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <!-- Golongan Darah -->
                                        <div class="mb-3">
                                            <label for="golongan_darah" class="form-label">Golongan Darah</label>
                                            <input type="text" id="golongan_darah" name="golongan_darah" class="form-control" placeholder="Golongan Darah" value="{{ old('golongan_darah', $data_row['golongan_darah'] ?? '') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Foto Siswa -->
                        <div class="mb-3">
                            <label for="foto_siswa" class="form-label">Foto Siswa</label>
                            <input type="file" id="foto_siswa" name="foto_siswa" class="form-control" accept="image/*">
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
    // Function untuk melakukan pencarian berdasarkan NIK Ayah
    function cariDataAyah() {
        var nikAyah = document.getElementById('nik_ayah').value; // Ambil NIK Ayah dari input
        // validasi jika nikAyah kosong
        if (nikAyah === '') {
            showModal('warning', 'NIK ayah tidak boleh kosong');
            return;
        }

        // Kirim permintaan AJAX ke controller
        fetch(`/orang-tua/${nikAyah}`)
            .then(response => response.json()) // Pastikan controller mengembalikan data dalam format JSON
            .then(data => {
                // Jika berhasil, isi form dengan data yang diterima
                if (data.status == 'success') {
                    //cek data jika jenis_orang_tua	itu ayah
                    if (data.data.jenis_orang_tua == 'Ayah') {
                        document.getElementById('nama_lengkap_ayah').value = data.data.nama_lengkap;
                        document.getElementById('pekerjaan_ayah').value = data.data.pekerjaan;
                        document.getElementById('alamat_ayah').value = data.data.alamat;
                        document.getElementById('nomor_telepon_ayah').value = data.data.nomor_telepon;
                        document.getElementById('email_ayah').value = data.data.email;
                        document.getElementById('con_ayah').value = 'existing'; // Menandakan data sudah ada
                    } else {
                        showModal('warning', 'NIK yang dimasukkan bukan data NIK ayah.');
                    }
                } else {
                    // Jika data tidak ditemukan
                    showModal('error', 'Data ayah tidak ditemukan.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Terjadi kesalahan dalam mengambil data.');
            });
    }
    // Function untuk melakukan pencarian berdasarkan NIK Ibu
    function cariDataIbu() {
        var nikIbu = document.getElementById('nik_ibu').value; // Ambil NIK Ibu dari input

        // Validasi jika nikIbu kosong
        if (nikIbu === '') {
            showModal('warning', 'NIK ibu tidak boleh kosong');
            return;
        }

        // Kirim permintaan AJAX ke controller
        fetch(`/orang-tua/${nikIbu}`)
            .then(response => response.json()) // Pastikan controller mengembalikan data dalam format JSON
            .then(data => {
                // Jika berhasil, isi form dengan data yang diterima
                if (data.status == 'success') {

                    // Cek apakah jenis_orang_tua adalah Ibu
                    if (data.data.jenis_orang_tua == 'Ibu') {
                        document.getElementById('nama_lengkap_ibu').value = data.data.nama_lengkap;
                        document.getElementById('pekerjaan_ibu').value = data.data.pekerjaan;
                        document.getElementById('alamat_ibu').value = data.data.alamat;
                        document.getElementById('nomor_telepon_ibu').value = data.data.nomor_telepon;
                        document.getElementById('email_ibu').value = data.data.email;
                        document.getElementById('con_ibu').value = 'existing'; // Menandakan data sudah ada
                    } else {
                        showModal('warning', 'NIK yang dimasukkan bukan data NIK ibu.');
                    }
                } else {
                    // Jika data tidak ditemukan
                    showModal('error', 'Data ibu tidak ditemukan.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Terjadi kesalahan dalam mengambil data.');
            });
    }
    // Function untuk melakukan pencarian berdasarkan NIK Wali
    function cariDataWali() {
        var nikWali = document.getElementById('nik_wali').value; // Ambil NIK Wali dari input

        // Validasi jika nikWali kosong
        if (nikWali === '') {
            showModal('warning', 'NIK wali tidak boleh kosong');
            return;
        }

        // Kirim permintaan AJAX ke controller
        fetch(`/orang-tua/${nikWali}`)
            .then(response => response.json()) // Pastikan controller mengembalikan data dalam format JSON
            .then(data => {
                // Jika berhasil, isi form dengan data yang diterima
                if (data.status == 'success') {
                    // Cek apakah jenis_orang_tua adalah Wali
                    if (data.data.jenis_orang_tua == 'Wali') {
                        document.getElementById('nama_lengkap_wali').value = data.data.nama_lengkap;
                        document.getElementById('pekerjaan_wali').value = data.data.pekerjaan;
                        document.getElementById('alamat_wali').value = data.data.alamat;
                        document.getElementById('nomor_telepon_wali').value = data.data.nomor_telepon;
                        document.getElementById('email_wali').value = data.data.email;
                        document.getElementById('hubungan_wali').value = data.data.hubungan;
                        document.getElementById('con_wali').value = 'existing'; // Menandakan data sudah ada
                    } else {
                        showModal('warning', 'NIK yang dimasukkan bukan data NIK wali.');
                    }
                } else {
                    // Jika data tidak ditemukan
                    showModal('error', 'Data wali tidak ditemukan.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showModal('error', 'Terjadi kesalahan dalam mengambil data.');
            });
    }

    // Function untuk menampilkan modal notifikasi
    function showModal(type, message) {
        var modal = new bootstrap.Modal(document.getElementById('alert-modal'));

        // Tentukan jenis modal berdasarkan tipe
        var iconClass = '';
        var title = '';
        var textClass = '';

        if (type === 'success') {
            iconClass = 'text-success';
            title = 'Berhasil';
        } else if (type === 'error') {
            iconClass = 'text-danger';
            title = 'Gagal';
        } else if (type === 'warning') {
            iconClass = 'text-warning';
            title = 'Peringatan';
        }

        // Ubah isi modal sesuai dengan pesan yang diberikan
        document.querySelector('#alert-modal svg').classList.remove('text-success', 'text-danger', 'text-warning');
        document.querySelector('#alert-modal svg').classList.add(iconClass);
        document.querySelector('#alert-modal h4').innerText = title;
        document.querySelector('#alert-modal p').innerText = message;

        // Tampilkan modal
        modal.show();
    }

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

    // Fungsi untuk menampilkan atau menyembunyikan form wali berdasarkan pilihan dropdown
    function toggleWaliForm() {
        var waliSelect = document.getElementById('wali');
        var waliForm = document.getElementById('wali_form');

        // Menampilkan form jika "Lain-lain" dipilih, jika tidak disembunyikan
        if (waliSelect.value === "Lain-lain") {
            waliForm.style.display = "block"; // Menampilkan form
        } else {
            waliForm.style.display = "none"; // Menyembunyikan form
        }
    }

    // Panggil fungsi untuk mengatur tampilan saat halaman dimuat
    window.onload = function() {
        toggleWaliForm(); // Menyembunyikan atau menampilkan form berdasarkan nilai dropdown saat halaman pertama kali dimuat
    };



    document.addEventListener("DOMContentLoaded", function() {
        // Data Dummy untuk testing
        // Data Dummy untuk testing
        const dataDummy = {
            nisn: "123456789",
            nama_lengkap: "John Doe",
            alamat: "Jl. Test No. 123, Jakarta",
            jenis_kelamin: "L",
            nomor_telepon: "(+62) 812 3456 7890",
            email: "johndoe@yahoo.com",
            tempat_lahir: "Jakarta",
            tanggal_lahir: "1990-01-01",
            status_pendidikan: "Aktif",
            agama: "Islam",
            tahun_masuk: "2010",
            tahun_lulus: "2014",
            golongan_darah: "O",
            foto_siswa: null, // Foto bisa ditambahkan jika tersedia

            // Data Orangtua (Dummy)
            nik_ayah: "1234567890123456", // NIK Ayah
            nama_lengkap_ayah: "Ayah Doe",
            pekerjaan_ayah: "PNS",
            alamat_ayah: "Jl. Ayah No. 10, Jakarta",
            nomor_telepon_ayah: "(+62) 812 1234 5678",
            email_ayah: "ayahd@yahoo.com",

            nik_ibu: "6543210987654321", // NIK Ibu
            nama_lengkap_ibu: "Ibu Doe",
            pekerjaan_ibu: "Guru",
            alamat_ibu: "Jl. Ibu No. 5, Jakarta",
            nomor_telepon_ibu: "(+62) 812 8765 4321",
            email_ibu: "ibud@yahoo.com",

            // Wali (Dummy, bisa dikosongkan jika tidak ada)
            type: "Lain-lain", // Wali adalah Ayah
            nik_wali: "1122334455667788", // NIK Wali
            nama_lengkap_wali: "Wali Dummy",
            pekerjaan_wali: "Pengusaha",
            alamat_wali: "Jl. Wali No. 20, Jakarta",
            nomor_telepon_wali: "(+62) 812 1111 2222",
            email_wali: "walidummy@yahoo.com",
            hubungan_wali: "Paman",
        };

        // Tab 1 (Siswa)
        document.getElementById("nisn").value = dataDummy.nisn;
        document.getElementById("nama_lengkap").value = dataDummy.nama_lengkap;
        document.getElementById("alamat").value = dataDummy.alamat;
        document.getElementById("jenis_kelamin").value = dataDummy.jenis_kelamin;
        document.getElementById("nomor_telepon").value = dataDummy.nomor_telepon;
        document.getElementById("email").value = dataDummy.email;
        document.getElementById("tempat_lahir").value = dataDummy.tempat_lahir;
        document.getElementById("tanggal_lahir").value = dataDummy.tanggal_lahir;
        document.getElementById("status_pendidikan").value = dataDummy.status_pendidikan;
        document.getElementById("agama").value = dataDummy.agama;
        document.getElementById("tahun_masuk").value = dataDummy.tahun_masuk;
        document.getElementById("tahun_lulus").value = dataDummy.tahun_lulus;
        document.getElementById("golongan_darah").value = dataDummy.golongan_darah;

        // Tab 2 (Ayah)
        document.getElementById("nik_ayah").value = dataDummy.nik_ayah || '';
        document.getElementById("nama_lengkap_ayah").value = dataDummy.nama_lengkap_ayah;
        document.getElementById("pekerjaan_ayah").value = dataDummy.pekerjaan_ayah;
        document.getElementById("alamat_ayah").value = dataDummy.alamat_ayah;
        document.getElementById("nomor_telepon_ayah").value = dataDummy.nomor_telepon_ayah;
        document.getElementById("email_ayah").value = dataDummy.email_ayah;

        // Tab 3 (Ibu)
        document.getElementById("nik_ibu").value = dataDummy.nik_ibu || '';
        document.getElementById("nama_lengkap_ibu").value = dataDummy.nama_lengkap_ibu;
        document.getElementById("pekerjaan_ibu").value = dataDummy.pekerjaan_ibu;
        document.getElementById("alamat_ibu").value = dataDummy.alamat_ibu;
        document.getElementById("nomor_telepon_ibu").value = dataDummy.nomor_telepon_ibu;
        document.getElementById("email_ibu").value = dataDummy.email_ibu;

        // Tab 4 (Wali)
        document.getElementById("wali").value = dataDummy.type || 'Ayah'; // Wali is Ayah, default to 'Ayah'
        if (dataDummy.type === 'Lain-lain') {
            document.getElementById("nik_wali").value = dataDummy.nik_wali || '';
            document.getElementById("nama_lengkap_wali").value = dataDummy.nama_lengkap_wali;
            document.getElementById("pekerjaan_wali").value = dataDummy.pekerjaan_wali;
            document.getElementById("alamat_wali").value = dataDummy.alamat_wali;
            document.getElementById("nomor_telepon_wali").value = dataDummy.nomor_telepon_wali;
            document.getElementById("email_wali").value = dataDummy.email_wali;
            document.getElementById("hubungan_wali").value = dataDummy.hubungan_wali;
        }
    });
</script>
@endsection