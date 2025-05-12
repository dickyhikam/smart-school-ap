@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Kategori -->
    <div class="row">
        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> {{ $nama_menu2 }}
                    </h4>
                </div>
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="petugas">Kode</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $data_peminjaman['kode_pinjam'] }}" name="petugas" id="petugas" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="petugas">Petugas</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $data_peminjaman['petugas']['name'] }}" name="petugas" id="petugas" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="metode">Metode</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{{ $data_peminjaman['metode'] }}" name="metode" id="metode" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_pinjam">Tanggal Pinjam</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{!! date('d-m-Y', strtotime($data_peminjaman['tanggal_pinjam'])) !!}" name="tanggal_pinjam" id="tanggal_pinjam" readonly>
                            </div>
                        </div>

                        @if($data_peminjaman['metode'] == 'online')
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_pengambilan">Tanggal Diambil</label>
                            <div class="col-md-9">
                                <input class="form-control" value="{!! date('d-m-Y', strtotime($data_peminjaman['tanggal_pengambilan'])) !!}" name="tanggal_pengambilan" id="tanggal_pengambilan" readonly>
                            </div>
                        </div>
                        @endif

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="tanggal_kembali">Tanggal Kembali</label>
                            <div class="col-md-9">
                                <input class="form-control"
                                    value="{!! date('d-m-Y', strtotime($data_peminjaman['tanggal_pinjam'] . ' +7 days')) !!}"
                                    name="tanggal_kembali"
                                    id="tanggal_kembali"
                                    readonly>
                                <small class="form-text text-muted">Tanggal kembali buku 7 hari setelah tanggal peminjaman.</small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="keterlambatan">Keterlambatan (hari)</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" id="keterlambatan" name="keterlambatan" value="0" readonly>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="denda">Denda yang Dibayar (IDR)</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" id="denda" name="denda" value="0" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-3 col-form-label" for="status">Status</label>
                            <div class="col-md-9">
                                <span class="badge 
                                    @if($data_peminjaman['status'] == 'dipinjam' || $data_peminjaman['status'] == 'diambil')
                                        bg-info
                                    @elseif($data_peminjaman['status'] == 'dikembalikan')
                                        bg-success
                                    @elseif($data_peminjaman['status'] == 'terlambat')
                                        bg-danger
                                    @else
                                        bg-secondary
                                    @endif
                                    fs-5 py-1 px-2">
                                    @switch($data_peminjaman['status'])
                                    @case('dipinjam')
                                    @case('diambil')
                                    Proses Peminjaman
                                    @break
                                    @case('dikembalikan')
                                    Pengembalian
                                    @break
                                    @case('terlambat')
                                    Keterlambatan Peminjaman
                                    @break
                                    @default
                                    {{$data_peminjaman['status']}}
                                    @endswitch
                                </span>

                            </div>
                        </div>


                        <div class="row">
                            @if($data_peminjaman['status'] == 'dipinjam' || $data_peminjaman['status'] == 'diambil')
                            <div class="col-md-4">
                                <button type="button" class="btn btn-secondary w-100" onclick="buttonBatal()">Batal</button>
                            </div>
                            <div class="col-md-8">
                                <button type="button" class="btn btn-primary w-100" id="buttonKembalikan" onclick="bukuKembali();">Kembalikan Buku</button>
                            </div>
                            @else
                            <div class="col-md-12">
                                <button type="button" class="btn btn-secondary w-100" onclick="buttonBatal()">Kembali</button>
                            </div>
                            @endif
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->

        <div class="col-sm-6">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i>Anggota
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tampilan Kartu Anggota -->
                    <div id="anggotaCard" class="">
                        <div class="card" style="width: 100%; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                            <div class="card-body d-flex align-items-center" style="padding: 20px;">

                                <!-- Foto Anggota (di sebelah kiri) -->
                                <div style="margin-right: 40px;">
                                    <img id="anggotaFoto" src="https://via.placeholder.com/100" alt="Foto Anggota" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f1f1f1;">
                                    <b class="text-danger">Belum ada di API</b>
                                </div>

                                <!-- Informasi Anggota (di sebelah kanan) -->
                                <div>
                                    <h5 class="card-title" style="font-size: 18px; font-weight: bold; color: #333;">{{ $data_peminjaman['peminjam']['name'] }}</h5>
                                    <p class="card-text" style="font-size: 14px; color: #777;">NISN: {{ $data_peminjaman['peminjam']['kode_pengguna'] }}</p>
                                </div>

                            </div>
                        </div>
                    </div>

                </div> <!-- end card body-->
            </div> <!-- end card -->

            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> List Buku
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tabel untuk menampilkan buku yang dipilih -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Gambar</th>
                                <th>Judul</th>
                                <th>Kode Items</th>
                                <th>Kondisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_peminjaman['buku'] as $key => $buku)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>
                                    @if($buku['gambar'])
                                    <img src="{{ asset('path/to/images/' . $buku['gambar']) }}" alt="Gambar Buku" style="width: 50px; height: auto;">
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>{{ $buku['judul'] }}</td>
                                <td>{{ $buku['buku_item']['kode_item'] }}</td>
                                <!-- <td>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Kode</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                
                                            </tr>
                                        </tbody>
                                    </table>
                                </td> -->
                                <td>
                                    @if($data_peminjaman['status'] == 'dipinjam' || $data_peminjaman['status'] == 'diambil')
                                    <select id="kondisi_buku" class="form-select" onchange="kondisiBuku(`{{ $buku['buku_item']['id'] }}`, this.value);">
                                        <option value="normal" selected>Normal</option>
                                        <option value="rusak">Rusak</option>
                                        <option value="hilang">Hilang</option>
                                    </select>
                                    @else
                                    <b class="text-danger">Belum ada di API</b>
                                    @endif

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>

    <!-- Modal for Book Return Confirmation -->
    <div class="modal fade" id="returnBookModal" tabindex="-1" aria-labelledby="returnBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="returnBookModalLabel">Konfirmasi Pengembalian Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Pastikan apakah data dan fisik buku sudah sesuai untuk dikembalikan?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('actionReturnPerpusPeminjaman', $data_peminjaman['id']) }}" method="POST" id="formSubmitReturn">
                        @csrf
                        <input class="form-control" type="text" id="konBuku" readonly hidden>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="returnButton">Ya, Kembalikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    // Initialize an object to store book conditions by ID
    let bookConditions = {};

    $(document).ready(function() {
        // Get the current date
        var currentDate = new Date();

        // Get the "Tanggal Kembali" date from the input
        var tanggalKembali = document.getElementById('tanggal_kembali').value;
        var tanggalKembaliDate = new Date(tanggalKembali.split('-').reverse().join('-')); // Convert d-m-Y format to Y-m-d format

        // Calculate the difference in days
        var timeDifference = currentDate - tanggalKembaliDate;
        var daysDifference = Math.floor(timeDifference / (1000 * 3600 * 24)); // Convert milliseconds to days

        // Update the "Keterlambatan" field with the calculated days
        document.getElementById('keterlambatan').value = daysDifference > 0 ? daysDifference : 0; // If negative, set to 0

        // If overdue (daysDifference > 0), change the style of the "Tanggal Kembali" field
        if (daysDifference > 0) {
            document.getElementById('tanggal_kembali').style.borderColor = 'red'; // Change border color to red
            document.getElementById('tanggal_kembali').style.backgroundColor = '#f8d7da'; // Optional: light red background
        }

        // Denda calculation (Assuming 1000 IDR per day of lateness)
        var dendaPerDay = 1000; // Fine per day in IDR
        var denda = daysDifference * dendaPerDay;

        // Update the "Denda" field with the calculated fine
        document.getElementById('denda').value = denda > 0 ? denda : 0; // If no fine, set to 0

        var submitButton = document.getElementById('returnButton');
        submitButton.disabled = false;
        submitButton.textContent = 'Ya, Kembalikan';

        // Menangani tombol "Simpan" untuk menghindari klik ganda
        document.getElementById('formSubmitReturn').addEventListener('submit', function(event) {
            // Menonaktifkan tombol dan mengubah teks menjadi "Sedang memproses..."
            submitButton.disabled = true;
            submitButton.textContent = 'Sedang memproses...';
        });

        // Initialize the bookConditions object with existing data
        @foreach($data_peminjaman['buku'] as $buku)
        kondisiBuku("{{ $buku['buku_item']['id'] }}", "normal");
        @endforeach
    });

    function kondisiBuku(id, kondisi) {
        // Update or add the kondisi for the given id
        bookConditions[id] = kondisi;

        // Convert the object to a string with each key-value pair as 'id|kondisi' and join with commas
        let bukuArray = Object.keys(bookConditions).map(key => `${key}|${bookConditions[key]}`);

        // Update the hidden input field with the new array of book ID and kondisi pairs
        $('#konBuku').val(bukuArray.join(','));
    }

    function bukuKembali() {
        $('#returnBookModal').modal('show');
    }

    function buttonBatal() {
        window.location.href = '{{ route("pagePerpusPeminjaman") }}';
    }
</script>
@endsection