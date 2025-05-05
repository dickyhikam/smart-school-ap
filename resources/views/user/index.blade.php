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
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered table-hover table-striped align-middle" id="siswaTable">
                            <thead class="table-primary sticky-top">
                                <tr>
                                    <th>Nama</th>
                                    <th>Role</th>
                                    <th>Platform</th>
                                    <th>Akses</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_data as $row)
                                <tr data-tahun="">
                                    <td>{{ $row['name'] }}</td>
                                    <td>{{ $row['pengguna']['type'] ?? '-' }}</td>
                                    <td>
                                        {{ $row['role']['allowed_platforms'] }}
                                    </td>
                                    <td>
                                        <ul class="m-0 p-0 list-unstyled">
                                            @foreach ($row['role']['permissions'] as $row3)
                                            <li>- {{ $row3 }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="text-center">
                                        @if ($row['is_active'] == 'Aktif')
                                        <span class="badge bg-success">Aktif</span>
                                        @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($row['is_active'] == 'Aktif')
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserStatus" data-status="Non-Aktif" data-id="{{ $row['id'] }}" title="Non-Aktif User">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M18 6l-12 12" />
                                                <path d="M6 6l12 12" />
                                            </svg>
                                        </button>
                                        @else
                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalUserStatus" data-status="Aktif" data-id="{{ $row['id'] }}" title="Aktif User">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M5 12l5 5l10 -10" />
                                            </svg>
                                        </button>
                                        @endif
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit User" onclick="window.location.href='{{ route('pageFormEditSiswa', ['id' => $row['id']]) }}'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="tooltip" title="Detil User" onclick="window.location.href='{{ route('pageFormEditSiswa', ['id' => $row['id']]) }}'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-analytics">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M9 17l0 -5" />
                                                <path d="M12 17l0 -1" />
                                                <path d="M15 17l0 -3" />
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
</div> <!-- container -->

<!-- Modal -->
<div class="modal fade" id="modalUserStatus" tabindex="-1" aria-labelledby="modalUserStatusLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalUserStatusLabel">Change User Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="statusMessage"></p>
            </div>
            <div class="modal-footer">
                <form id="statusChangeForm" method="POST" action="{{ route('actionStatusUser') }}">
                    @csrf
                    <input type="text" name="id" id="id" hidden>
                    <input type="text" name="is_active" id="is_active" hidden>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-primary">Ya</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('javascript_custom')
<script>
    // Event listener to handle modal show
    var myModal = document.getElementById('modalUserStatus');
    myModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // Button that triggered the modal
        var status = button.getAttribute('data-status'); // Extract the status
        var id = button.getAttribute('data-id'); // Extract the user id

        document.getElementById('is_active').value = status;
        document.getElementById('id').value = id; // Set the user id in the form

        // Set the modal content dynamically
        var statusMessage = document.getElementById('statusMessage');
        statusMessage.textContent = 'Apakah Anda yakin ingin mengubah status user menjadi "' + status + '"?';
    });
</script>
@endsection