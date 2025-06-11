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

                    <div class="d-flex justify-content-end gap-2">
                        <!-- Tombol Buat Akademik di kiri -->
                        <a class="btn btn-soft-info btn-sm d-flex align-items-center gap-1" href="{{ route('pageFormAkademik') }}">
                            <i class="mdi mdi-plus"></i> Buat Akademik
                        </a>
                        <!-- Tombol Tambah {{ $nama_menu }} di kanan -->
                        <a class="btn btn-soft-primary btn-sm d-flex align-items-center gap-1" href="{{ route('pageFormTahunAjaran') }}">
                            <i class="mdi mdi-plus"></i> Tambah {{ $nama_menu }}
                        </a>
                    </div>
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
                                    <th>Tahun Ajaran</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($list_data) > 0)
                                @foreach ($list_data as $row)
                                <tr>
                                    <td>{{ $row['tahun_ajaran'] }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $row['status']['value'] == '1' ? 'bg-success' : 'bg-warning' }}">
                                            {{ $row['status']['label'] }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        @if ($row['status']['value'] == '0')
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalKonfirmStatus" data-status="1" data-id="{{ $row['id'] }}" data-name="{{ $row['tahun_ajaran'] }}" title="Aktif Tahun Ajaran">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </button>
                                        @endif
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit {{ $nama_menu }}" onclick="window.location.href='{{ route('pageFormEditTahunAjaran', ['id' => $row['id']]) }}'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button hidden class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" title="Hapus {{ $nama_menu }}" data-menu-id="{{ $row['id'] }}" data-menu-name="{{ $row['tahun_ajaran'] }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada data yang tersedia</td>
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
    // Get all delete buttons
    const deleteButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#deleteModal"]');

    // Loop through each button and add an event listener
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const menuId = this.getAttribute('data-menu-id'); // Get menu ID from button's data-menu-id attribute
            const menuName = this.getAttribute('data-menu-name');
            const form = document.querySelector('#deleteModal form'); // Get the form in the modal
            form.action = form.action.replace(':id', menuId); // Replace the route parameter with the actual ID
            document.getElementById('deleteModalName').textContent = menuName; // Set the menu name in the modal
        });
    });

    // Event listener to handle modal show
    var myModal = document.getElementById('modalKonfirmStatus');
    myModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var status = button.getAttribute('data-status'); // Extract the status
        var id = button.getAttribute('data-id'); // Extract the user id
        var name = button.getAttribute('data-name'); // Extract the tahun ajaran

        document.getElementById('is_active').value = status;
        document.getElementById('th_name').value = name;

        // Set the form action URL dynamically by adding the ID to the URL
        var form = document.getElementById('statusChangeForm');
        form.action = "{{ route('actionEditTahunAjaran', ['id' => '']) }}/" + id;

        // Set the modal content dynamically
        var statusMessage = document.getElementById('statusMessage');
        statusMessage.innerHTML = `
            <div style="font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6;">
                <p style="font-weight: bold; color: #333;">Apakah Anda yakin ingin mengubah status tahun ajaran <span style="color: #007bff;">${name}</span> menjadi "<span style="color: #28a745;">Aktif</span>"?</p>
                <hr style="border: 1px solid #ddd; margin: 10px 0;">
                <p style="font-size: 14px; color: #555;">
                    <i style="color: #f39c12;" class="fa fa-info-circle"></i>
                    Catatan: Tahun ajaran yang diaktifkan akan berubah sepenuhnya pada proses belajar mengajar. Pastikan semua persiapan sudah matang sebelum melanjutkan.
                </p>
            </div>
        `;
    });
</script>
@endsection