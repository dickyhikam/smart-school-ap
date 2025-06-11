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
                        <i class="mdi mdi-account-group me-2"></i> Data {{ $nama_menu }}
                    </h4>
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
                                    <th>Tanggal Kembali</th>
                                    <th>Denda</th>
                                    <th>Buku</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list_data) > 0)
                                @foreach ($list_data as $row)
                                <tr>
                                    <td>{{ $row['kode_pinjam'] }}</td>
                                    <td>{{ $row['peminjam']['name'] }}</td>
                                    <td>{{ $row['petugas']['name'] }}</td>
                                    <td>{!! date('d-m-Y', strtotime($row['tanggal_pengembalian'])) !!}</td>
                                    <td>0</td>
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
                                        <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detil Data {{ $nama_menu }}" onclick="btn_detil(this);" data-id="{{ $row['id'] }}">
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
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="9" class="text-center">Tidak ada data yang tersedia</td>
                                </tr>
                                @endif
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