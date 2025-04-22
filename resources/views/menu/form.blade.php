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
                    <form action="{{ $action }}" method="POST">
                        @csrf
                        @if($method == 'PUT')
                        @method('PUT') <!-- Menandakan bahwa ini adalah update -->
                        @endif

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="name">Nama Menu <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" class="form-control" placeholder="Nama Menu" value="{{ old('name', $data_row['name'] ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="route">Route <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="route" name="route" class="form-control" placeholder="Route" value="{{ old('route', $data_row['route'] ?? '') }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="icon">Icon <span class="text-danger">*</span></label>
                            <div class="col-md-9 d-flex align-items-center">
                                <!-- Input field for the icon class -->
                                <input type="text" id="icon" name="icon" class="form-control" placeholder="Icon (e.g., fas fa-user-friends)" value="{{ old('icon', $data_row['icon'] ?? '') }}" required>
                                <!-- Icon Display (next to the input) -->
                                <div id="icon-display" class="ms-2">
                                    <i class="{{ old('icon', $data_row['icon'] ?? '') }}" style="font-size: 24px;"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="platform">Platform <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="platform" name="platform" class="form-select" required>
                                    <option value="" selected>Pilih Platform</option>
                                    <option value="web" {{ (old('platform', $data_row['platform'] ?? '') == 'web') ? 'selected' : '' }}>Web</option>
                                    <option value="mobile" {{ (old('platform', $data_row['platform'] ?? '') == 'mobile') ? 'selected' : '' }}>Mobile</option>
                                    <option value="both" {{ (old('platform', $data_row['platform'] ?? '') == 'both') ? 'selected' : '' }}>Both</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="order">Order <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="number" id="order" name="order" class="form-control" placeholder="Order" value="{{ old('order', $data_row['order'] ?? 0) }}" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="permission">Permission</label>
                            <div class="col-md-9">
                                <input type="text" id="permission" name="permission" class="form-control" placeholder="Permission" value="{{ old('permission', $data_row['permission'] ?? '') }}">
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
    // Get elements
    const iconInput = document.getElementById('icon');
    const iconDisplay = document.getElementById('icon-display');

    // Function to update the icon preview as the user types
    iconInput.addEventListener('input', function() {
        const iconClass = iconInput.value.trim();

        // Check if the class is valid and update the icon
        if (iconClass) {
            iconDisplay.innerHTML = `<i class="${iconClass}" style="font-size: 24px;"></i>`;
        } else {
            iconDisplay.innerHTML = '<small>Icon tidak ditemukan</small>'; // Clear the icon if input is empty
        }
    });

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