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
                                <input id="tanggal_pengadaan" name="tanggal_pengadaan" class="form-control" placeholder="Masukkan tanggal pengadaan" value="{{ old('tanggal_pengadaan', date('d-m-Y', strtotime($data_row['tanggal_pengadaan'] ?? ''))) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="kategori_id">Kategori <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select id="kategori_id" name="kategori_id[]" class="form-control select2-multiple" multiple="multiple" required data-placeholder="Pilih Kategori">
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
                            <label for="gambar_cover" class="col-md-3 col-form-label">Cover <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="file" id="gambar_cover" name="gambar_cover" class="form-control" accept="image/*" onchange="previewImage(event)">
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
    $(document).ready(function() {
        // Ambil data old() dan kategori dari data_row
        var selectedCategories = <?= json_encode(old('kategori_id', [])); ?>;
        var selectedCategoryNames = <?= json_encode($data_row['kategori_buku'] ?? []); ?>;
        var allCategories = <?= json_encode($list_kategori); ?>;

        // Panggil fungsi untuk mengatur kategori yang dipilih
        setSelectedCategories('#kategori_id', selectedCategories, selectedCategoryNames, allCategories);

        flatpickr("#tanggal_pengadaan", {
            enableTime: false,
            dateFormat: "d-m-Y", // Pastikan format ini sesuai
            defaultDate: "{{ old('tanggal_pengadaan', date('d-m-Y', strtotime($data_row['tanggal_pengadaan'] ?? $date_now))) }}", // Pastikan format tanggal sama dengan input
        });
    });

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