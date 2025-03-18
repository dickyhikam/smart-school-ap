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
        color: #fd7e14;
    }

    .text-purple {
        color: #6f42c1;
    }
</style>

<div class="page-container">

    <div class="row row-cols-xxl-4 row-cols-md-2 row-cols-1">
        <!-- Tahun Ajaran -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header bg-white border-0 align-items-center">
                    <div class="icon-circle text-blue">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-week">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                            <path d="M16 3v4" />
                            <path d="M8 3v4" />
                            <path d="M4 11h16" />
                            <path d="M7 14h.013" />
                            <path d="M10.01 14h.005" />
                            <path d="M13.01 14h.005" />
                            <path d="M16.015 14h.005" />
                            <path d="M13.015 17h.005" />
                            <path d="M7.01 17h.005" />
                            <path d="M10.01 17h.005" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Tahun Ajaran</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-blue">2024/2025</h2>
                    <p class="text-muted mb-0">Tahun Ajaran Saat Ini</p>
                </div>
            </div>
        </div>

        <!-- Guru -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header bg-white border-0 align-items-center">
                    <div class="icon-circle text-green">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Guru</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-green" data-plugin="counterup">120</h2>
                    <p class="text-muted mb-0">Total Guru</p>
                </div>
            </div>
        </div>

        <!-- Siswa -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header bg-white border-0 align-items-center">
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
                        <h5 class="mb-0">Siswa</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-orange" data-plugin="counterup">2,300</h2>
                    <p class="text-muted mb-0">Total Siswa</p>
                </div>
            </div>
        </div>

        <!-- Orang Tua/Wali -->
        <div class="col">
            <div class="card card-anim border-0">
                <div class="d-flex card-header bg-white border-0 align-items-center">
                    <div class="icon-circle text-purple">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                        </svg>
                    </div>
                    <div class="ms-3">
                        <h5 class="mb-0">Orang Tua/Wali</h5>
                    </div>
                </div>

                <div class="card-body text-center">
                    <h2 class="fw-bold text-purple" data-plugin="counterup">4,500</h2>
                    <p class="text-muted mb-0">Total Orang Tua/Wali</p>
                </div>
            </div>
        </div>

    </div><!-- end row -->

    <div class="row">
        <div class="col-xxl-12 col-xl-12">
            <div class="card">
                <div class="d-flex card-header justify-content-between align-items-center border-bottom border-dashed">
                    <h4 class="header-title">Data Siswa Tahunan</h4>
                </div>

                <div class="card-body p-0 pt-1 mb-2">
                    <div dir="ltr" class="px-1">
                        <div id="statistics-chart" class="apex-charts" data-colors="#188ae2"></div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div> <!-- end row-->

</div> <!-- container -->

@endsection