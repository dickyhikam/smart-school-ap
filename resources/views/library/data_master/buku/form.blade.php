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
                    <form id="formBuku" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="judul">Judul <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="judul" name="judul" class="form-control" placeholder="Masukkan judul" value="{{ old('judul', $data_row['judul'] ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tahun_terbit">Tahun Terbit <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="tahun_terbit" name="tahun_terbit" class="form-control select2" data-toggle="select2" required>
                                    <option value="">Pilih Tahun Terbit</option>
                                    <?php
                                    $current_year = date('Y');
                                    for ($year = $current_year; $year >= 1900; $year--) {
                                        $selected = ($year == old('tahun_terbit', $data_row['tahun_terbit'] ?? '')) ? 'selected' : '';
                                        echo "<option value='$year' $selected>$year</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_pengadaan">Tanggal Pengadaan <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input id="tanggal_pengadaan2" name="tanggal_pengadaan2" class="form-control" placeholder="Masukkan tanggal pengadaan" required>
                                <input id="tanggal_pengadaan" name="tanggal_pengadaan" hidden class="form-control" placeholder="Masukkan tanggal pengadaan" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="kategori_ids">Kategori <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="kategori_ids" name="kategori_ids[]" class="form-control select2-multiple" multiple="multiple" required data-placeholder="Pilih Kategori">
                                    <?php foreach ($list_kategori as $kategori): ?>
                                        <option value="<?= $kategori['id']; ?>"><?= $kategori['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="jumlah">Jumlah <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Masukkan jumlah" value="{{ old('jumlah', $data_row['jumlah'] ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="rak_kode">Rak Kode <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="rak_kode" name="rak_kode" class="form-control" placeholder="Masukkan rak kode" value="{{ old('rak_kode', $data_row['rak_kode'] ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="pengarang_id">Pengarang <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="pengarang_id" name="pengarang_id" class="form-control select2" required>
                                    <option value="">Pilih Pengarang</option>
                                    <?php foreach ($list_pengarang as $pengarang): ?>
                                        <option value="<?= $pengarang['id']; ?>"
                                            <?= (old('pengarang_id') == $pengarang['id'] || ($data_row['pengarang']['nama'] ?? '') == $pengarang['nama']) ? 'selected' : ''; ?>>
                                            <?= $pengarang['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="penerbit_id">Penerbit <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="penerbit_id" name="penerbit_id" class="form-control select2" required>
                                    <option value="">Pilih Penerbit</option>
                                    <?php foreach ($list_penerbit as $penerbit): ?>
                                        <option value="<?= $penerbit['id']; ?>"
                                            <?= (old('penerbit_id') == $penerbit['id'] || ($data_row['penerbit']['nama'] ?? '') == $penerbit['nama']) ? 'selected' : ''; ?>>
                                            <?= $penerbit['nama']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="keterangan">Keterangan</label>
                            <div class="col-md-9">
                                <textarea id="keterangan" name="keterangan" class="form-control" placeholder="Masukkan keterangan"><?= isset($data_row['keterangan']) ? htmlspecialchars($data_row['keterangan']) : ''; ?></textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="gambar" class="col-md-3 col-form-label">Cover <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label"></label>
                            <div class="col-md-9">
                                <!-- Tempat untuk menampilkan gambar setelah diunggah -->
                                <div id="foto-preview-container">
                                    <!-- Jika foto sudah ada, tampilkan gambar yang sudah ada -->
                                    <?php if (!empty($data_row['gambar'])): ?>
                                        <img src="<?= $data_row['gambar'] ?>" class="img-thumbnail" style="max-width: 200px;" alt="Foto Siswa">
                                    <?php else: ?>
                                        <p>Tidak ada foto yang diunggah.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid gap-2">
                            <button type="button" id="btnSubmit" class="btn btn-primary">Simpan</button>
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
    $(document).ready(function() {
        // Ambil data old() dan kategori dari data_row
        var selectedCategories = <?= json_encode(old('kategori_ids', [])); ?>;
        var selectedCategoryNames = <?= json_encode($data_row['kategori_buku'] ?? []); ?>;
        var allCategories = <?= json_encode($list_kategori); ?>;

        // Panggil fungsi untuk mengatur kategori yang dipilih
        setSelectedCategories('#kategori_ids', selectedCategories, selectedCategoryNames, allCategories);

        flatpickr("#tanggal_pengadaan", {
            enableTime: false,
            dateFormat: "Y-m-d", // Pastikan format ini sesuai
            defaultDate: "{{ old('tanggal_pengadaan', date('Y-m-d', strtotime($data_row['tanggal_pengadaan'] ?? $date_now))) }}", // Pastikan format tanggal sama dengan input
        });
        flatpickr("#tanggal_pengadaan2", {
            enableTime: false,
            dateFormat: "d-m-Y", // Pastikan format ini sesuai
            defaultDate: "{{ old('tanggal_pengadaan2', date('d-m-Y', strtotime($data_row['tanggal_pengadaan2'] ?? $date_now))) }}", // Pastikan format tanggal sama dengan input
        });

        $('#btnSubmit').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Disable the submit button and change the text to 'Sedang memproses...'
            var submitButton = $('#btnSubmit');
            submitButton.prop('disabled', true);
            submitButton.text('Sedang memproses...');

            // Create a FormData object to send form data and file
            var formData = new FormData($('#formBuku')[0]);

            // Get the CSRF token from the meta tag
            var token = $('meta[name="csrf-token"]').attr('content'); // Ensure CSRF token is available in meta tag

            // Construct the URL with optional ID
            var url = '{{ env("API_URL") }}/api/perpustakaan/buku';
            @if(isset($id_data) && $id_data)
            url += '/{{ $id_data }}'; // Append ID if available
            @endif

            // Send the request using AJAX
            $.ajax({
                url: url, // The dynamically constructed URL
                type: 'POST',
                data: formData,
                processData: false, // Don't process the data into a query string
                contentType: false, // Keep the content type as 'multipart/form-data'
                headers: {
                    'X-CSRF-TOKEN': token, // Add CSRF token to headers for Laravel
                    'Authorization': 'Bearer ' + '{{ $token }}' // Bearer token injected dynamically by Blade
                },
                success: function(response) {
                    // Handle success and show the notification alert
                    notif_alert(response.status, response.message);

                    // Re-enable the submit button after success or error
                    submitButton.prop('disabled', false);
                    submitButton.text('Simpan');
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

                    // Re-enable the submit button after error
                    submitButton.prop('disabled', false);
                    submitButton.text('Simpan');
                }
            });
        });

        // Optional: Handle form submit event if you use submit button as a real submit
        document.getElementById('formBuku').addEventListener('submit', function(event) {
            var submitButton = document.getElementById('btnSubmit');
            submitButton.disabled = true;
            submitButton.textContent = 'Sedang memproses...';
        });
    });

    function notif_alert(status, message) {
        var alertType, alertIcon, alertTitle;

        // Determine alert type based on response
        if (status === 'success') {
            alertType = 'success';
            alertIcon = '<svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><g fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" /></g></svg>';
            alertTitle = 'Berhasil';
        } else {
            alertType = 'error';
            alertIcon = '<svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"><path fill="currentColor" d="M10.03 8.97a.75.75 0 0 0-1.06 1.06L10.94 12l-1.97 1.97a.75.75 0 1 0 1.06 1.06L12 13.06l1.97 1.97a.75.75 0 0 0 1.06-1.06L13.06 12l1.97-1.97a.75.75 0 1 0-1.06-1.06L12 10.94z" /><path fill="currentColor" fill-rule="evenodd" d="M12.057 1.25h-.114c-2.309 0-4.118 0-5.53.19c-1.444.194-2.584.6-3.479 1.494c-.895.895-1.3 2.035-1.494 3.48c-.19 1.411-.19 3.22-.19 5.529v.114c0 2.309 0 4.118.19 5.53c.194 1.444.6 2.584 1.494 3.479c.895.895 2.035 1.3 3.48 1.494c1.411.19 3.22.19 5.529.19h.114c2.309 0 4.118 0 5.53-.19c1.444-.194 2.584-.6 3.479-1.494c.895-.895 1.3-2.035 1.494-3.48c.19-1.411.19-3.22.19-5.529v-.114c0-2.309 0-4.118-.19-5.53c-.194-1.444-.6-2.584-1.494-3.479c-.895-.895-2.035-1.3-3.48-1.494c-1.411-.19-3.22-.19-5.529-.19M3.995 3.995c.57-.57 1.34-.897 2.619-1.069c1.3-.174 3.008-.176 5.386-.176s4.086.002 5.386.176c1.279.172 2.05.5 2.62 1.069c.569.57.896 1.34 1.068 2.619c.174 1.3.176 3.008.176 5.386s-.002 4.086-.176 5.386c-.172 1.279-.5 2.05-1.069 2.62c-.57.569-1.34.896-2.619 1.068c-1.3.174-3.008.176-5.386.176s-4.086-.002-5.386-.176c-1.279-.172-2.05-.5-2.62-1.069c-.569-.57-.896-1.34-1.068-2.619c-.174-1.3-.176-3.008-.176-5.386s.002-4.086.176-5.386c.172-1.279.5-2.05 1.069-2.62" clip-rule="evenodd" /></svg>';
            alertTitle = 'Gagal';
        }

        // Set the modal content dynamically
        $('#alert-icon2').html(alertIcon);
        $('#alert-title2').text(alertTitle);
        $('#alert-message2').text(message || 'Terjadi kesalahan saat menyimpan data.');
        // Show the modal
        $('#alert-modal2').modal('show');

        // Add an event listener to the "Tutup" button
        $('#alert-modal2 .btn-info').on('click', function() {
            // If status is "error", just dismiss the modal without redirecting
            if (status === 'success') {
                // If status is "success", redirect after closing the modal
                window.location.href = '{{ route("pagePerpusBuku") }}'; // Replace '/new-route' with the desired route
            } else {
                $('#alert-modal2').modal('hide'); // Close the modal
            }
        });
    }

    // Fungsi untuk menginisialisasi dan memilih kategori
    function setSelectedCategories(selectElementId, oldCategoryIds, categoryNames, allCategories) {
        // Inisialisasi Select2 pada elemen select
        $(selectElementId).select2();

        // Gabungkan ID kategori yang dipilih dari old() dan nama kategori dari data_row
        var selectedValues = [];

        // Ambil ID kategori yang ada dalam selectedCategoryNames (dari nama kategori)
        categoryNames.forEach(function(row_data) {
            var categoryId = allCategories.find(function(item) {
                return item.nama === row_data.nama;
            })?.id;

            if (categoryId) {
                selectedValues.push(categoryId);
            }
        });

        // Gabungkan kategori ID dari old() dan kategori yang ditemukan dari nama
        selectedValues = selectedValues.concat(oldCategoryIds);

        // Set kategori yang dipilih di select2
        $(selectElementId).val(selectedValues).trigger('change');
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
</script>
@endsection