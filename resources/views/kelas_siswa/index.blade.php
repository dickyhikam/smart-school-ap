@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center flex-column py-2">
                <div class="d-flex justify-content-between w-100 mb-3">
                    <!-- Tombol Kiri -->
                    <a id="prev-btn" class="btn btn-outline-info {{ $tahun_ajaran_prev == '' ? 'disabled' : '' }}" data-bs-toggle="tooltip" title="Tahun Ajaran Sebelumnya" href="{{ $tahun_ajaran_prev == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_prev }}">
                        <svg id="prev-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-left">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 6l-6 6l6 6v-12" />
                        </svg>
                    </a>

                    <!-- Judul dan Garis Header -->
                    <div class="d-flex justify-content-center align-items-center flex-column">
                        <h2 class="font-weight-bold text-uppercase mb-1 {{ $tahun_ajaran_status == 'Aktif' ? 'text-success' : 'text-danger' }}"
                            style="font-size: 40px; letter-spacing: 3px; transition: all 0.3s ease;">
                            {{ $tahun_ajaran }}
                        </h2>
                        <div class="line-header mb-1" style="width: 50px; height: 4px; background-color: <?= $tahun_ajaran_status == 'Aktif' ? '#28a745' : '#dc3545' ?>;">
                        </div>
                        <span class="badge {{ $tahun_ajaran_status == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                            Tahun ajaran sedang {{ $tahun_ajaran_status }}
                        </span>
                    </div>

                    <!-- Tombol Kanan -->
                    <a id="next-btn" class="btn btn-outline-info {{ $tahun_ajaran_next == '' ? 'disabled' : '' }}" data-bs-toggle="tooltip" title="Tahun Ajaran Selanjutnya" href="{{ $tahun_ajaran_next == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_next }}">
                        <svg id="next-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-caret-right">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 18l6 -6l-6 -6v12" />
                        </svg>
                    </a>
                </div>
            </div>


            <div class="card shadow-sm">
                <div class="card-header border-bottom border-dashed d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="mdi mdi-account-group me-2"></i> Data {{ $nama_menu }}
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Bagian Search dan Show Entries  -->
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
                                    <th>Kelas</th>
                                    <th>Wali Kelas</th>
                                    <th class="text-center">Siswa</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_data as $row)
                                <tr>
                                    <td>{{ $row['kelas']['nama'].' - '.$row['nama'] }}</td>
                                    <td>{{ $row['wali_kelas']['nama_lengkap'] }}</td>
                                    <td>
                                        @if (empty($row['siswa']))
                                        <p class="text-center text">Tidak ada siswa di kelas ini.</p>
                                        @else
                                        <table class="table table-sm table-bordered table-hover table-striped align-middle">
                                            <thead class="table-primary sticky-top">
                                                <tr>
                                                    <th>NISN</th>
                                                    <th>Nama</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($row['siswa'] as $siswa)
                                                <tr>
                                                    <td>{{ $siswa['siswa']['nisn'] }}</td>
                                                    <td>{{ $siswa['siswa']['nama_lengkap'] }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="tooltip" title="Detil Kelas" onclick="window.location.href='{{ route('pageDetilKelasSiswa', ['id' => $row['id']]) }}'" @if($tahun_ajaran_status!=='Aktif' ) disabled @endif>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                                                <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                                                <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                                <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
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

                                    {{-- Show ellipsis if there are more pages before or after --}}
                                    @if ($pagination['current_page'] - 2 > 1)
                                    <li class="page-item disabled">
                                        <span class="page-link">...</span>
                                    </li>
                                    @endif

                                    {{-- Previous Pages and Current --}}
                                    @for ($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['last_page'], $pagination['current_page'] + 2); $i++)
                                        <li class="page-item {{ $i == $pagination['current_page'] ? 'active' : '' }}">
                                        <a href="?page={{ $i }}" class="page-link">{{ $i }}</a>
                                        </li>
                                        @endfor

                                        @if ($pagination['current_page'] + 2 < $pagination['last_page'])
                                            <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                            </li>
                                            @endif

                                            {{-- Next Pages --}}
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

    <!-- Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus menu ini <b id="deleteModalName"></b>?</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('actionDeleteTahunAjaran', ['id' => ':id']) }}" method="POST" id="deleteMenuForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalKonfirmStatus" tabindex="-1" aria-labelledby="modalKonfirmStatusLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalKonfirmStatusLabel">Konformasi Status Tahun Ajaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="statusMessage"></p>
                </div>
                <div class="modal-footer">
                    <form id="statusChangeForm" method="PUT" action="{{ route('actionEditTahunAjaran', ['id' => '']) }}">
                        @csrf
                        <input type="text" name="th_name" id="th_name" readonly>
                        <input type="text" name="is_active" id="is_active" readonly>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" class="btn btn-primary">Ya</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> <!-- container -->

@endsection

@section('javascript_custom')
<script>
    $(document).ready(function() {
        // Panggil fungsi untuk tombol
        handleButtonClick('prev-btn', 'prev-icon', `{{ $tahun_ajaran_prev == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_prev }}`);
        handleButtonClick('next-btn', 'next-icon', `{{ $tahun_ajaran_next == '' ? 'javascript:void(0)' : '?th=' . $tahun_ajaran_next }}`);
    });
</script>
@endsection