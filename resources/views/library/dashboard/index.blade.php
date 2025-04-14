@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<style>
    .card {
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .card-anim:hover {
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background-color: rgba(0, 123, 255, 0.1);
        font-size: 24px;
    }

    .text-blue {
        color: #007bff;
    }

    .text-green {
        color: #28a745;
    }

    .text-orange {
        color: rgb(66, 193, 189);
    }

    .text-purple {
        color: rgb(253, 20, 20);
    }
</style>

<div class="page-container">

    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
        <!-- Buku -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-books">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                            <path d="M9 4m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v14a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                            <path d="M5 8h4" />
                            <path d="M9 16h4" />
                            <path d="M13.803 4.56l2.184 -.53c.562 -.135 1.133 .19 1.282 .732l3.695 13.418a1.02 1.02 0 0 1 -.634 1.219l-.133 .041l-2.184 .53c-.562 .135 -1.133 -.19 -1.282 -.732l-3.695 -13.418a1.02 1.02 0 0 1 .634 -1.219l.133 -.041z" />
                            <path d="M14 9l4 -1" />
                            <path d="M16 16l3.923 -.98" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Buku</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-blue" data-plugin="counterup">200</h2>
                    <p class="text-muted mb-0">Total Buku</p>
                </div>
            </div>
        </div>

        <!-- Anggota -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-orange">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users-group">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1" />
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M17 10h2a2 2 0 0 1 2 2v1" />
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Anggota</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-orange" data-plugin="counterup">2,300</h2>
                    <p class="text-muted mb-0">Total Anggota</p>
                </div>
            </div>
        </div>

        <!-- Guru -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                            <path d="M9 12h12l-3 -3" />
                            <path d="M18 15l3 -3" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Peminjaman</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-green" data-plugin="counterup">120</h2>
                    <p class="text-muted mb-0">Total Peminjaman</p>
                </div>
            </div>
        </div>

        <!-- Orang Tua/Wali -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header  border-0 align-items-center">
                    <div class="icon-circle text-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                            <path d="M3 12h13l-3 -3" />
                            <path d="M13 15l3 -3" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Pengembalian</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-purple" data-plugin="counterup">4,500</h2>
                    <p class="text-muted mb-0">Total Pengembalian</p>
                </div>
            </div>
        </div>

    </div><!-- end row -->

    <div class="row">
        <div class="col-xxl-7 col-xl-8">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Data Transaksi</h4>
                </div>

                <div class="card-body p-0 pt-1 mb-2">
                    <div dir="ltr" class="px-1">
                        <div id="statistics-chart" class="apex-charts" data-colors="#188ae2"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->

        <div class="col-xxl-5 col-xl-4">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Literasi</h4>
                </div>

                <div class="card-body p-0 pt-1 mb-2">
                    <div id="calendar"></div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

</div> <!-- container -->

@endsection