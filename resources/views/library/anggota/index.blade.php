@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<div class="page-container">

    <!-- Tabel Data Orang Tua/Wali -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center gap-2">
                    <h4 class="mb-0">Data Non-Anggota</h4>

                    <div class="d-flex align-items-start flex-wrap justify-content-sm-end gap-2">
                        <form>
                            <div class="d-flex align-items-start flex-wrap">
                                <label for="membersearch-input" class="visually-hidden">Search</label>
                                <input type="search" class="form-control" id="membersearch-input" placeholder="cari siswa...">
                            </div>
                        </form>

                        <button type="button" class="btn btn-info btn-sm" id="toggleButton">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="card-body" id="cardBody" style="background-color:rgb(235, 235, 235); display: none;">
                    <div class="row">
                        @foreach ($list_siswa as $row)
                        <div class="col-xl-2 col-md-4 col-sm-6">
                            <div class="card text-center">
                                <div class="card-body">
                                    <img src="{{ $row['foto']['url'] }}" class="rounded-circle img-thumbnail avatar-xl mt-1" alt="profile-image">
                                    <h4 class="mt-3">{{ $row['nisn'] }}</h4>
                                    <h5 class="mb-1">{{ $row['nama_lengkap'] }}</h5>
                                    <h5 class="text-muted">Kelas <span> | </span>Wali Kelas</h5>
                                    <div class="d-grid gap-2 mt-2 mb-2">
                                        <button class="btn btn-soft-secondary rounded-pill"
                                            data-bs-toggle="modal" data-bs-target="#gabungModal"
                                            data-nisn="{{ $row['id'] }}"
                                            data-student-name="{{ $row['nama_lengkap'] }}">
                                            Gabung
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

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
                                    <th>Nama</th>
                                    <th>Tipe Anggota</th>
                                    <th hidden>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_data as $row)
                                <tr>
                                    <td>{!! $row['pengguna']['nama'] ?? '-' !!}</td>
                                    <td>{!! $row['pengguna']['type'] ?? '-' !!}</td>
                                    <td hidden>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit {{ $nama_menu }}" onclick="window.location.href='{{ route('pageFormEditGuru', ['id' => $row['id']]) }}'">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus {{ $nama_menu }}">
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
    <div class="modal fade" id="gabungModal" tabindex="-1" aria-labelledby="gabungModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="gabungModalLabel">Konfirmasi Bergabung</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menggabungkan siswa <b id="studentName"></b> menjadi anggota perpustakaan?</p>
                </div>
                <div class="modal-footer">
                    <form id="gabungForm">
                        <input id="id_gabung" name="user_id" readonly hidden>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger" id="confirmGabungBtn">Gabung</button>
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
        // Intercept the form submission
        $('#gabungForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            // Disable the submit button to prevent multiple clicks
            var submitButton = $('#confirmGabungBtn');
            submitButton.prop('disabled', true);
            submitButton.text('Sedang memproses...');

            // Gather form data
            var formData = new FormData(this);

            // Get the CSRF token
            var token = $('meta[name="csrf-token"]').attr('content');

            // Send the request using AJAX
            $.ajax({
                url: '{{ env("API_URL") }}/api/perpustakaan/anggota', // The form's action URL
                type: 'POST',
                data: formData,
                processData: false, // Don't process the data into a query string
                contentType: false, // Set the content type as 'multipart/form-data'
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
                // Reload the page after closing the modal
                location.reload();
            } else {
                $('#alert-modal2').modal('hide'); // Close the modal
            }
        });
    }

    // Get all Gabung buttons
    const gabungButtons = document.querySelectorAll('[data-bs-toggle="modal"][data-bs-target="#gabungModal"]');

    // Loop through each button and add an event listener
    gabungButtons.forEach(button => {
        button.addEventListener('click', function() {
            const menuId = this.getAttribute('data-nisn'); // Get menu ID from button's data-menu-id attribute
            const menuName = this.getAttribute('data-student-name');
            const form = document.querySelector('#gabungModal form'); // Get the form in the modal

            document.getElementById('id_gabung').value = menuId;

            document.getElementById('studentName').textContent = menuName; // Set the menu name in the modal
        });
    });

    // Menangani tombol "Hapus" untuk menghindari klik ganda
    document.getElementById('gabungForm').addEventListener('submit', function(event) {
        // Ambil tombol Hapus
        var confirmGabungBtn = document.getElementById('confirmGabungBtn');

        // Nonaktifkan tombol dan ubah teks menjadi "Sedang memproses..."
        confirmGabungBtn.disabled = true;
        confirmGabungBtn.textContent = 'Sedang memproses...';
    });

    document.getElementById("toggleButton").addEventListener("click", function() {
        var cardBody = document.getElementById("cardBody");
        var toggleButton = document.getElementById("toggleButton");

        // Toggle the visibility of the card body
        if (cardBody.style.display === "none") {
            cardBody.style.display = "block";
            // Change icon to minus
            toggleButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-minus">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M5 12l14 0" />
                                </svg>`;
        } else {
            cardBody.style.display = "none";
            // Change icon to plus
            toggleButton.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>`;
        }
    });
</script>
@endsection