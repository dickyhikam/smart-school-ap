@extends('layouts.auth')

@section('title', $nama_menu)

@section('content')

<div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

    <h4 class="fw-semibold mb-3 fs-18">Log in ke akun Anda</h4>

    <form action="{{ route('actionLogin') }}" method="POST" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="username">NIP/NIS</label>
            <input id="username" name="username" class="form-control" placeholder="Masukkan NIP/NIS anda">
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password anda">
                <button class="btn btn-light" type="button"><i class="ri-eye-off-fill"></i></button>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="checkbox-signin">
                <label class="form-check-label" for="checkbox-signin">Remember me</label>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary fw-semibold" type="submit">Login</button>
        </div>
    </form>

    <p class="text-muted fs-14 mb-0">Login sebagai?
        <a href="auth-register.php" class="fw-semibold text-danger ms-1">Siswa</a> |<a href="auth-register.php" class="fw-semibold text-danger ms-1">Orang Tua</a>
    </p>

</div>
@endsection

@section('javascript_custom')
<script>
    // Menangani submit form dengan fetch
    document.getElementById('login-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Mencegah form submit secara default

        // Ambil data form
        const formData = new FormData(this); // Ambil semua data dari form
        const formObject = {};

        formData.forEach((value, key) => {
            formObject[key] = value;
        });

        // Tentukan URL endpoint (untuk create atau update)
        const apiUrl = 'https://service-smartschool.bina-inspirasi.id/api/user';
        // Tentukan method berdasarkan _method field (POST atau PUT)
        const method = 'POST';

        //check method ketika PUT
        const formDataNew = {
            username: formObject.username,
            password: formObject.password
        };

        // Kirim request dengan fetch
        fetch(apiUrl, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formDataNew),
            })
            .then(response => {
                if (!response.ok) { // Cek jika status response bukan OK (200)
                    throw new Error('Network response was not ok ' + response.status);
                }
                return response.json();
            })
            .then(result => {
                if (result.errors) {
                    alert('Data gagal disimpan.');
                } else {
                    alert('Data berhasil disimpan.');
                }
            })
            .catch(error => {
                console.error('Fetch Error:', error);
                alert('Terjadi kesalahan saat mengirim permintaan.');
            });
    });
</script>
@endsection