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
                        <i class="mdi mdi-account-group me-2"></i> Data Orang Tua/Wali
                    </h4>

                    <button class="btn btn-soft-primary btn-sm d-flex align-items-center gap-1">
                        <i class="mdi mdi-plus"></i> Tambah Orang Tua/Wali
                    </button>
                </div>
                <div class="card-body">
                    <!-- Bagian Search dan Show Entries -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="d-flex">
                                <label class="d-flex align-items-center fw-semibold">Tampilkan </label>
                                <select class="form-select d-inline-block ms-2">
                                    <option value="10">10</option>
                                    <option value="30">30</option>
                                    <option value="50">50</option>
                                    <option value="70">70</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <!-- Search Input -->
                            <div class="d-flex align-items-start flex-wrap">
                                <label for="membersearch-input" class="visually-hidden">Search</label>
                                <input type="search" class="form-control border-light bg-light bg-opacity-50" id="membersearch-input" placeholder="Search...">
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                        <table class="table table-bordered table-hover table-striped align-middle" id="siswaTable">
                            <thead class="table-primary sticky-top">
                                <tr>
                                    <th>#</th>
                                    <th>NISN</th>
                                    <th>Nama</th>
                                    <th>Kelas</th>
                                    <th>Orang Tua/Wali</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Contoh Data Siswa -->
                                <tr data-tahun="2023/2024">
                                    <td>1</td>
                                    <td>1234567890</td>
                                    <td>Ahmad Fadilah</td>
                                    <td>10 IPA 1</td>
                                    <td>
                                        <ul class="m-0 p-0 list-unstyled">
                                            <li>- Budi Santoso</li>
                                            <li>- Rina Sari</li>
                                        </ul>
                                    </td>
                                    <td><span class="badge bg-success">Aktif</span></td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Edit Siswa">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                <path d="M16 5l3 3" />
                                            </svg>
                                        </button>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Hapus Siswa">
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
                                <!-- Data siswa lainnya -->
                            </tbody>
                        </table>
                    </div> <!-- end table-responsive -->

                    <div class="row align-items-center mb-3">
                        <div class="col-sm-6">
                            <div>
                                <p class="fs-14 m-0 text-body text-muted">Menampilkan <span class="text-body fw-semibold">10</span> dari <span class="text-body fw-semibold">52</span> data</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-end">
                                <ul class="pagination pagination-boxed mb-sm-0">
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link"><i class="ti ti-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active">
                                        <a href="#" class="page-link">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">4</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link">5</a>
                                    </li>
                                    <li class="page-item">
                                        <a href="#" class="page-link"><i class="ti ti-chevron-right"></i></a>
                                    </li>
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

</script>
@endsection