<!-- Datatables css -->
<link href="{{ asset('assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

<!-- dropzone css -->
<link rel="stylesheet" href="{{ asset('assets/vendor/dropzone/dropzone.css') }}" type="text/css" />

<!-- Theme Config Js -->
<script src="{{ asset('assets/js/config.js') }}"></script>

<!-- Vendor css -->
<link href="{{ asset('assets/css/vendor.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App css -->
<link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

<!-- Icons css -->
<link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<!-- toastr css -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
    c {
        color: red;
    }

    input[readonly] {
        background-color: #f0f0f0;
        /* Warna latar belakang lebih terang */
        color: #6c757d;
        /* Warna teks lebih gelap atau abu-abu */
        border-color: #ccc;
        /* Warna border yang lebih netral */
        cursor: not-allowed;
        /* Mengubah kursor menjadi tidak diperbolehkan */
        pointer-events: none;
        /* Tidak bisa diklik atau dipilih */
        opacity: 1;
        /* Menjaga elemen tetap tidak transparan */
    }

    input[readonly]:focus {
        border-color: #ccc;
        /* Menghindari perubahan border saat fokus */
        box-shadow: none;
        /* Menghilangkan bayangan fokus */
    }
</style>