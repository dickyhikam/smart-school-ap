<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.title-meta')

    @include('partials.head-css')
</head>

<body>

    <div class="auth-bg d-flex min-vh-100">
        <div class="row g-0 justify-content-center w-100 m-xxl-5 px-xxl-4 m-3">
            <div class="col-xxl-4 col-lg-5 col-md-6">

                <a href="{{ route('pageDashboard') }}" class="auth-brand d-flex justify-content-center mb-2">
                    <img src="assets/images/logo-dark.png" alt="dark logo" height="26" class="logo-dark">
                    <img src="assets/images/logo.png" alt="logo light" height="26" class="logo-light">
                </a>

                <br>

                @yield('content')

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
                                    <svg class="text-info" xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-info-square">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M12 9h.01" />
                                        <path d="M3 5a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14z" />
                                        <path d="M11 12h1v4h1" />
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

                <p class="mt-4 text-center mb-0">
                    <script>
                        document.write(new Date().getFullYear())
                    </script> ©
                </p>
            </div>
        </div>
    </div>

    @include('partials.footer-scripts')
    @yield('javascript_custom')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Periksa jika ada pesan dari session
            @if(session('message'))
            var modal = new bootstrap.Modal(document.getElementById('alert-modal'));
            modal.show();
            @endif
        });
    </script>

</body>

</html>