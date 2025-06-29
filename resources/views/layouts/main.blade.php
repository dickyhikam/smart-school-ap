<!DOCTYPE html>
<html lang="en" data-sidenav-size="default">

<head>
    @include('partials.title-meta')

    @include('partials.head-css')

    <style>
        .No_API {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        @include('partials.topbar')

        @include('partials.sidenav')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->
        <div class="page-content">

            @yield('content')

            @include('partials.footer')

        </div>
        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

        <!-- Alert Modal -->
        <div id="alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <!-- Ikon alert sesuai jenis pesan -->
                            @if(session('alert-type') == 'success')
                            <svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                                </g>
                            </svg>

                            <!-- Judul pesan -->
                            <h4 class="mt-2">Berhasil</h4>
                            @elseif(session('alert-type') == 'error')
                            <svg class="text-danger" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10.03 8.97a.75.75 0 0 0-1.06 1.06L10.94 12l-1.97 1.97a.75.75 0 1 0 1.06 1.06L12 13.06l1.97 1.97a.75.75 0 0 0 1.06-1.06L13.06 12l1.97-1.97a.75.75 0 1 0-1.06-1.06L12 10.94z" />
                                <path fill="currentColor" fill-rule="evenodd" d="M12.057 1.25h-.114c-2.309 0-4.118 0-5.53.19c-1.444.194-2.584.6-3.479 1.494c-.895.895-1.3 2.035-1.494 3.48c-.19 1.411-.19 3.22-.19 5.529v.114c0 2.309 0 4.118.19 5.53c.194 1.444.6 2.584 1.494 3.479c.895.895 2.035 1.3 3.48 1.494c1.411.19 3.22.19 5.529.19h.114c2.309 0 4.118 0 5.53-.19c1.444-.194 2.584-.6 3.479-1.494c.895-.895 1.3-2.035 1.494-3.48c.19-1.411.19-3.22.19-5.529v-.114c0-2.309 0-4.118-.19-5.53c-.194-1.444-.6-2.584-1.494-3.479c-.895-.895-2.035-1.3-3.48-1.494c-1.411-.19-3.22-.19-5.529-.19M3.995 3.995c.57-.57 1.34-.897 2.619-1.069c1.3-.174 3.008-.176 5.386-.176s4.086.002 5.386.176c1.279.172 2.05.5 2.62 1.069c.569.57.896 1.34 1.068 2.619c.174 1.3.176 3.008.176 5.386s-.002 4.086-.176 5.386c-.172 1.279-.5 2.05-1.069 2.62c-.57.569-1.34.896-2.619 1.068c-1.3.174-3.008.176-5.386.176s-4.086-.002-5.386-.176c-1.279-.172-2.05-.5-2.62-1.069c-.569-.57-.896-1.34-1.068-2.619c-.174-1.3-.176-3.008-.176-5.386s.002-4.086.176-5.386c.172-1.279.5-2.05 1.069-2.62" clip-rule="evenodd" />
                            </svg>


                            <!-- Judul pesan -->
                            <h4 class="mt-2">Gagal!</h4>
                            @elseif(session('alert-type') == 'warning')
                            <svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path stroke="currentColor" stroke-width="2" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 8v4" />
                                    <circle cx="12" cy="15" r="1" fill="currentColor" />
                                </g>
                            </svg>

                            <!-- Judul pesan -->
                            <h4 class="mt-2">Peringatan!</h4>
                            @else
                            <svg class="text-info" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                                </g>
                            </svg>

                            <!-- Judul pesan -->
                            <h4 class="mt-2">Informasi</h4>

                            @endif

                            <!-- Pesan yang dikirim dari controller -->
                            <p class="mt-3">{{ session('message') }}</p>

                            <!-- Tombol untuk menutup modal -->
                            <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Alert Modal -->
        <div id="alert-modal2" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <!-- Icon (will be updated dynamically) -->
                            <div id="alert-icon2">
                                <!-- Icon will be injected here -->
                            </div>

                            <!-- Dynamic Title (success, error, warning, info) -->
                            <h4 id="alert-title2" class="mt-2"></h4>

                            <!-- Dynamic Message (from AJAX response) -->
                            <p id="alert-message2" class="mt-3"></p>

                            <!-- Close button -->
                            <button type="button" class="btn btn-info my-2" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END wrapper -->

    <!-- @include('partials.customizer') -->

    @include('partials.footer-scripts')

    <script>
        $(document).ready(function() {
            $('#alert-modal2').modal({
                backdrop: 'static',
                keyboard: false
            })
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Periksa jika ada pesan dari session
            @if(session('message'))
            var modal = new bootstrap.Modal(document.getElementById('alert-modal'));
            modal.show();
            @endif
        });

        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }

        function hanyaAngka(e, decimal) {
            var key;
            var keychar;
            if (window.event) {
                key = window.event.keyCode;
            } else if (e) {
                key = e.which;
            } else {
                return true;
            }
            keychar = String.fromCharCode(key);
            if ((key === null) || (key === 0) || (key === 8) || (key === 9) || (key === 13) || (key === 27)) {
                return true;
            } else if ((("0123456789").indexOf(keychar) > -1)) {
                return true;
            } else if (decimal && (keychar === ".")) {
                return true;
            } else {
                return false;
            }
        }

        // Fungsi untuk menampilkan loading
        function showLoading(btn, icon) {
            // Nonaktifkan tombol
            btn.classList.add('disabled');
            icon.classList.add('d-none'); // Menyembunyikan ikon

            // Membuat elemen spinner
            let spinner = document.createElement('span');
            spinner.classList.add('spinner-border', 'spinner-border-sm');
            spinner.setAttribute('role', 'status');
            spinner.setAttribute('aria-hidden', 'true');

            // Menambahkan spinner ke dalam tombol (btn)
            btn.appendChild(spinner);
        }

        // Fungsi untuk menyembunyikan loading
        function hideLoading(btn, icon) {
            // Menghapus kelas disabled
            btn.classList.remove('disabled');
            icon.classList.remove('d-none'); // Menampilkan kembali ikon

            // Cari spinner yang sudah ditambahkan ke tombol
            let spinner = btn.querySelector('.spinner-border');

            // Hapus spinner jika ada
            if (spinner) {
                spinner.remove();
            }
        }

        // Fungsi umum untuk menangani tombol dengan loading
        function handleButtonClick(buttonId, iconId, href) {
            const btn = document.getElementById(buttonId);
            const icon = document.getElementById(iconId);

            // Event listener untuk tombol
            btn.addEventListener('click', function(e) {
                // Cek jika tombol tidak disabled
                if (!btn.classList.contains('disabled')) {
                    showLoading(btn, icon); // Menampilkan loading
                    // Menunggu efek loading, bisa diganti dengan AJAX atau refresh
                    setTimeout(function() {
                        window.location.href = href; // Arahkan ke URL tujuan
                    }, 1000); // Waktu loading 1 detik
                }
            });
        }

        function notif_alert(status, message) {
            var alertType, alertIcon, alertTitle;

            // Determine alert type based on response
            if (status === 'success') {
                alertType = 'success';
                alertIcon = `<svg class="text-success" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="1.5">
                                    <circle cx="12" cy="12" r="10" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                                </g>
                            </svg>`;
                alertTitle = 'Berhasil';
            } else if (status === 'warning') {
                alertType = 'warning';
                alertIcon = `<svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path stroke="currentColor" stroke-width="2" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 8v4" />
                                    <circle cx="12" cy="15" r="1" fill="currentColor" />
                                </g>
                            </svg>`;
                alertTitle = 'Peringatan!';
            } else if (status === 'info') {
                alertType = 'info';
                alertIcon = `<svg class="text-info" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.5 12.5l2 2l5-5" />
                                </g>
                            </svg>`;
                alertTitle = 'Informasi';
            } else {
                alertType = 'error';
                alertIcon = `<svg class="text-warning" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24">
                                <g fill="none">
                                    <path stroke="currentColor" stroke-width="2" d="M3 10.417c0-3.198 0-4.797.378-5.335c.377-.537 1.88-1.052 4.887-2.081l.573-.196C10.405 2.268 11.188 2 12 2s1.595.268 3.162.805l.573.196c3.007 1.029 4.51 1.544 4.887 2.081C21 5.62 21 7.22 21 10.417v1.574c0 5.638-4.239 8.375-6.899 9.536C13.38 21.842 13.02 22 12 22s-1.38-.158-2.101-.473C7.239 20.365 3 17.63 3 11.991z" />
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M12 8v4" />
                                    <circle cx="12" cy="15" r="1" fill="currentColor" />
                                </g>
                            </svg>`;
                alertTitle = 'Gagal';
            }

            // Set the modal content dynamically
            $('#alert-icon2').html(alertIcon);
            $('#alert-title2').text(alertTitle);
            $('#alert-message2').text(message || 'Terjadi kesalahan saat menyimpan data.');
            // Show the modal
            $('#alert-modal2').modal('show');
        }
    </script>

    @yield('javascript_custom')

</body>

</html>