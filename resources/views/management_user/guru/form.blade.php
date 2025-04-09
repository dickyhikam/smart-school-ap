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
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('nama_lengkap', $data_row->nama_lengkap ?? '') }}" required>
                        </div>

                        <!-- NIP -->
                        <div class="mb-3">
                            <label for="nip" class="form-label">NIP <span class="text-danger">*</span></label>
                            <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP" value="{{ old('nip', $data_row->nip ?? '') }}" required>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Tempat Lahir -->
                                <div class="mb-3">
                                    <label for="tempat_lahir" class="form-label">Tempat Lahir <span class="text-danger">*</span></label>
                                    <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $data_row->tempat_lahir ?? '') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- Tanggal Lahir -->
                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $data_row->tanggal_lahir ?? '') }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-select" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ (old('jenis_kelamin', $data_row->jenis_kelamin ?? '') == 'L') ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ (old('jenis_kelamin', $data_row->jenis_kelamin ?? '') == 'P') ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        <!-- Agama -->
                        <div class="mb-3">
                            <label for="agama" class="form-label">Agama <span class="text-danger">*</span></label>
                            <select id="agama" name="agama" class="form-select" required>
                                <option value="" disabled>Pilih Agama</option>
                                <option value="Islam" {{ (old('agama', $data_row->agama ?? '') == 'Islam') ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ (old('agama', $data_row->agama ?? '') == 'Kristen') ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ (old('agama', $data_row->agama ?? '') == 'Katolik') ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ (old('agama', $data_row->agama ?? '') == 'Hindu') ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ (old('agama', $data_row->agama ?? '') == 'Buddha') ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ (old('agama', $data_row->agama ?? '') == 'Khonghucu') ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                            <textarea id="alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat" required>{{ old('alamat', $data_row->alamat ?? '') }}</textarea>
                        </div>

                        <!-- Nomor Telepon -->
                        <div class="mb-3">
                            <label for="nomor_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" id="nomor_telepon" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" value="{{ old('nomor_telepon', $data_row->nomor_telepon ?? '') }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ old('email', $data_row->email ?? '') }}" required>
                        </div>

                        <!-- Status Kepegawaian -->
                        <div class="mb-3">
                            <label for="status_kepegawaian" class="form-label">Status Kepegawaian <span class="text-danger">*</span></label>
                            <select id="status_kepegawaian" name="status_kepegawaian" class="form-select" required>
                                <option value="PNS" {{ (old('status_kepegawaian', $data_row->status_kepegawaian ?? '') == 'PNS') ? 'selected' : '' }}>PNS</option>
                                <option value="Non-PNS" {{ (old('status_kepegawaian', $data_row->status_kepegawaian ?? '') == 'Non-PNS') ? 'selected' : '' }}>Non-PNS</option>
                            </select>
                        </div>

                        <!-- Tahun Masuk -->
                        <div class="mb-3">
                            <label for="tahun_masuk" class="form-label">Tahun Masuk <span class="text-danger">*</span></label>
                            <input type="number" id="tahun_masuk" name="tahun_masuk" class="form-control" placeholder="Tahun Masuk" value="{{ old('tahun_masuk', $data_row->tahun_masuk ?? '') }}" required>
                        </div>

                        <!-- Foto Guru -->
                        <div class="mb-3">
                            <label for="foto_guru" class="form-label">Foto Guru</label>
                            <input type="file" id="foto_guru" name="foto_guru" class="form-control" accept="image/*">
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

</script>
@endsection