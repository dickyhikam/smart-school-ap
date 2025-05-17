@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Data Pinjam Online
                    </h4>
                </div>
                <div class="card-body">
                    <input type="text" id="cari_online" class="form-control mb-2" placeholder="Cari kode pinjam" data-bs-toggle="tooltip" title="Masukkan kode peminjaman" />

                    <div class="row">
                        <div class="col-sm-4">
                            <!-- Card Peminjam -->
                            <div class="card shadow-sm border-0 rounded-3 mb-3">
                                <div class="card-body">
                                    @forelse ($list_data_online as $row)
                                    <div class="d-flex align-items-center">
                                        <!-- Foto Peminjam -->
                                        <img src="https://randomuser.me/api/portraits/men/30.jpg" alt="Foto Peminjam" class="rounded-circle border border-3 border-primary" width="100" height="100" />

                                        <!-- Informasi Peminjam -->
                                        <div class="ms-3" style="width: 100%;">
                                            <div class="card-title">
                                                <h4 class="text-primary fw-bold">John Doe - NISN</h4>
                                                <h5><b>JM-2024-05-0004</b></h5>
                                            </div>
                                            <table style="width: 100%;">
                                                <tr>
                                                    <td class="text-center">01 Mei 2025</td>
                                                    <td rowspan="2">
                                                        <center>-</center>
                                                    </td>
                                                    <td class="text-center">02 Mei 2025</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">09:00</td>
                                                    <td class="text-center">09:00</td>
                                                </tr>
                                            </table>
                                            <ul class="list-group list-group-flush" style="max-height: 100px; overflow-y: auto;">
                                                <li class="list-group-item">- Belajar PHP untuk Pemula</li>
                                                <li class="list-group-item">- Mastering Laravel</li>
                                                <li class="list-group-item">- Web Development with React</li>
                                                <li class="list-group-item">- Introduction to Python</li>
                                                <li class="list-group-item">- Learn JavaScript Basics</li>
                                            </ul>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-soft-primary rounded-pill w-100" onclick="buttonBatal()">Detil Data</button>
                                    @endforeach
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div>
                    </div>

                </div> <!-- end card body-->

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="mdi mdi-account-group me-2"></i> Data {{ $nama_menu }}
                </h4>

                <a class="btn btn-soft-primary btn-sm d-flex align-items-center gap-1" href="{{ route('pageFormPerpusPeminjaman') }}">
                    <i class="mdi mdi-plus"></i> Tambah {{ $nama_menu }}
                </a>
            </div>
            <div class="card-body">
                <!-- Bagian Search dan Show Entries -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <div class="d-flex">
                            <label class="d-flex align-items-center text-muted">Tampilkan </label>
                            <form method="GET" action="{{ url()->current() }}" class="d-flex">
                                <select name="per_page" class="form-select d-inline-block ms-2" onchange="this.form.submit()">
                                    <option value="10" {{ request('per_page') == '10' ? 'selected' : '' }}>10</option>
                                    <option value="30" {{ request('per_page') == '30' ? 'selected' : '' }}>30</option>
                                    <option value="50" {{ request('per_page') == '50' ? 'selected' : '' }}>50</option>
                                    <option value="70" {{ request('per_page') == '70' ? 'selected' : '' }}>70</option>
                                    <option value="100" {{ request('per_page') == '100' ? 'selected' : '' }}>100</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div>
                        <!-- Search Input -->
                        <form method="GET" action="{{ url()->current() }}" class="d-flex align-items-start flex-wrap">
                            <label for="membersearch-input" class="visually-hidden">Search</label>
                            <input type="search" name="search" id="membersearch-input" class="form-control border-light bg-light bg-opacity-50"
                                value="{{ request('search') }}" placeholder="Search..." onchange="this.form.submit()">
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped align-middle" id="siswaTable">
                        <thead class="table-primary sticky-top">
                            <tr>
                                <th>Kode Peminjaman</th>
                                <th>Nama Peminjam</th>
                                <th>Petugas</th>
                                <th>Metode Pinjaman</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                                <th>Buku</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($list_data as $row)
                            <tr>
                                <td>{{ $row['kode_pinjam'] }}</td>
                                <td>{{ $row['peminjam']['name'] }}</td>
                                <td>{{ $row['petugas']['name'] }}</td>
                                <td>{{ $row['metode'] }}</td>
                                <td>{!! date('d-m-Y', strtotime($row['tanggal_pinjam'])) !!}</td>
                                <td>{!! date('d-m-Y', strtotime($row['tanggal_pinjam'] . ' +7 days')) !!}</td>
                                <td>
                                    @foreach ($row['buku'] as $buku)
                                    <li>{{ $buku['judul'] }}</li>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge {{ in_array($row['status'], ['dikembalikan']) ? 'bg-success' : (in_array($row['status'], ['dipinjam', 'diambil']) ? 'bg-info' : 'bg-danger') }}">
                                        {{ $row['status'] == 'dikembalikan' ? 'Dikembalikan' : ($row['status'] == 'dipinjam' || $row['status'] == 'diambil' ? 'Dipinjam' : 'Terlambat') }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detil {{ $nama_menu }}" onclick="btn_detil(this);" data-id="{{ $row['id'] }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                            <path d="M9 12h6" />
                                            <path d="M9 16h6" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="text-center">Tidak ada data yang tersedia</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div> <!-- end table-responsive -->

                <div class="row align-items-center mb-3 mt-2">
                    <div class="col-sm-6">
                        <div>
                            <p class="fs-14 m-0 text-body text-muted">
                                Menampilkan <span class="text-body fw-semibold">{{ $pagination['from'] }}</span> hingga <span class="text-body fw-semibold">{{ $pagination['to'] }}</span> dari <span class="text-body fw-semibold">{{ $pagination['total'] }}</span> data
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="float-sm-end">
                            <ul class="pagination pagination-boxed mb-sm-0">
                                @if ($pagination['current_page'] > 1)
                                <li class="page-item">
                                    <a href="{{ $pagination['prev_page_url'] }}" class="page-link">
                                        <i class="ti ti-chevron-left"></i>
                                    </a>
                                </li>
                                @endif

                                @for ($i = 1; $i <= $pagination['last_page']; $i++)
                                    <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                    <a href="?page={{ $i }}" class="page-link">{{ $i }}</a>
                                    </li>
                                    @endfor

                                    @if ($pagination['current_page'] < $pagination['last_page'])
                                        <li class="page-item">
                                        <a href="{{ $pagination['next_page_url'] }}" class="page-link">
                                            <i class="ti ti-chevron-right"></i>
                                        </a>
                                        </li>
                                        @endif
                            </ul>
                        </div>
                    </div>
                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    // Mengupdate modal dengan nama buku yang akan dikembalikan
    document.querySelectorAll('[data-bs-toggle="modal"]').forEach((button) => {
        button.addEventListener('click', function() {
            const bookName = this.getAttribute('data-book-names');
            const bookId = this.getAttribute('data-book-id');
            const peminjam = this.getAttribute('data-peminjam');

            // Update modal dengan nama buku
            document.getElementById('returnModalBookName').textContent = bookName;
            document.getElementById('returnModalPeminjam').textContent = peminjam;


            // Update action URL form dengan ID buku yang sesuai
            const form = document.getElementById('returnBookForm');
            form.action = form.action.replace(':id', bookId);
        });
    });

    function btn_detil(button) {
        // Retrieve the ID from the button's data-id attribute
        var id = $(button).data('id'); // Using jQuery to get the data-id attribute

        // Construct the URL dynamically by appending the `id` to the route
        var url = '{{ route("pageDetilPerpusPeminjaman", ["id" => ":id"]) }}';
        url = url.replace(':id', id); // Replace the ":id" placeholder with the actual `id`

        // Redirect to the new URL
        window.location.href = url;
    }
</script>
@endsection