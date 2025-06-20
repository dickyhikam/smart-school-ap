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
                            <label for="tahun" class="col-md-3 col-form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="tahun" name="tahun" class="form-control" value="{{ old('tahun', $data_row['tahun_ajaran'] ?? '') }}" placeholder="Masukkan tahun ajaran" required>
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="tahun" class="col-md-3 col-form-label">An</label>
                            <div class="col-md-9">
                                <input readonly id="st_ta" name="status" class="form-control" value="{{ old('status', $data_row['status']['value'] ?? '0') }}">
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="id" class="col-md-3 col-form-label">An</label>
                            <div class="col-md-9">
                                <input readonly id="id" name="id" class="form-control" value="{{ old('id', $data_row['id'] ?? '0') }}">
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