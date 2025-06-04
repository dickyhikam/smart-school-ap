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
                            <label for="nama" class="col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $data_row['nama'] ?? '') }}" placeholder="Masukkan nama jurusan" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="stat" class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="stat" name="status" class="form-select" required>
                                    <option value="1" {{ (old('status', $data_row['status']['value'] ?? '') == '1') ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ (old('status', $data_row['status']['value'] ?? '') == '0') ? 'selected' : '' }}>Non-Aktif</option>
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
    // Menangani tombol "Simpan" untuk menghindari klik ganda
    document.getElementById('formSubmit').addEventListener('submit', function(event) {
        var submitButton = document.getElementById('submitButton');

        // Menonaktifkan tombol dan mengubah teks menjadi "Sedang memproses..."
        submitButton.disabled = true;
        submitButton.textContent = 'Sedang memproses...';
    });
</script>
@endsection