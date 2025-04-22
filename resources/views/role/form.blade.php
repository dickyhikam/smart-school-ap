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

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label class="col-form-label" for="nama">Nama <span class="text-danger">*</span></label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukkan nama" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <!-- Platform -->
                                <div class="mb-3">
                                    <label class="col-form-label" for="platform">Platform <span class="text-danger">*</span></label>
                                    <select id="platform" name="platform" class="form-select" required>
                                        <option value="" selected>Pilih Platform</option>
                                        <option value="web" {{ (old('platform', $data_row['allowed_platforms'] ?? '') == 'web') ? 'selected' : '' }}>Web</option>
                                        <option value="mobile" {{ (old('platform', $data_row['allowed_platforms'] ?? '') == 'mobile') ? 'selected' : '' }}>Mobile</option>
                                        <option value="both" {{ (old('platform', $data_row['allowed_platforms'] ?? '') == 'both') ? 'selected' : '' }}>Both</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Simpan</button>
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
</script>
@endsection