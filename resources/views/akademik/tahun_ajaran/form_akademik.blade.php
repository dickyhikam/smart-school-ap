@extends('layouts.main')

@section('title', $nama_menu)

@section('content')
<style>
    /* Menonaktifkan klik pada tab */
    .disabled-tab {
        pointer-events: none;
        /* Menonaktifkan semua interaksi klik */
        /* opacity: 0.5; */
        /* Mengurangi opacity agar tab terlihat nonaktif */
    }
</style>
<div class="page-container">

    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" role="tablist">
        <li class="nav-item" role="presentation">
            <a href="#home1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 active disabled-tab" aria-selected="true" role="tab">
                Tahun Ajaran
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#profile1" data-bs-toggle="tab" aria-expanded="true" class="nav-link rounded-0 disabled-tab" aria-selected="false" role="tab">
                Sub Kelas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 disabled-tab" aria-selected="false" role="tab">
                Siswa Kelas
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a href="#settings1" data-bs-toggle="tab" aria-expanded="false" class="nav-link rounded-0 disabled-tab" aria-selected="false" role="tab">
                Jadwal Pelajaran
            </a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="home1" role="tabpanel">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form id="formTA">
                        @csrf
                        <div class="row mb-3">
                            <label for="tahun" class="col-md-3 col-form-label">Tahun Ajaran <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" id="tahun" name="tahun" class="form-control" value="{{ old('tahun', $data_row['tahun_ajaran'] ?? '') }}" placeholder="Masukkan tahun ajaran" required>
                            </div>
                        </div>
                        <div class="row mb-3" hidden>
                            <label for="status_tahun" class="col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <select name="status_tahun" id="status_tahun">
                                    <option value="0" selected>Non-Aktif</option>
                                    <option value="1">Aktif</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">

                            </div>
                            <div class="col-sm-6">
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-primary" id="btnTA" onclick="submitTA();">Selanjutnya</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div>
        <div class="tab-pane fade" id="profile1" role="tabpanel">
            <!-- Content for Profile Tab -->
            Profile Content
        </div>
        <div class="tab-pane fade" id="settings1" role="tabpanel">
            <!-- Content for Settings Tab -->
            Settings Content
        </div>
    </div>

</div> <!-- container -->
@endsection

@section('javascript_custom')
<script>
    function submitTA() {
        
    }
</script>
@endsection