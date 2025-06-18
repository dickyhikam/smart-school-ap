@extends('layouts.auth')

@section('title', $nama_menu)

@section('content')

<div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

    <h4 class="fw-semibold mb-3 fs-18">Log in ke akun Anda</h4>

    <form action="{{ route('login') }}" method="POST" class="text-start mb-3">
        @csrf
        <div class="mb-3">
            <label class="form-label" for="username">NIP/NIS</label>
            <input id="username" name="username" class="form-control" placeholder="Masukkan NIP/NIS anda" value="{{ old('username') }}" required>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password anda" value="{{ old('password') }}" required>
                <button class="btn btn-light" type="button" onclick="togglePassword()"><i class="ri-eye-off-fill" id="eyeIcon"></i></button>
            </div>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="checkbox-signin" name="remember">
                <label class="form-check-label" for="checkbox-signin">Remember me</label>
            </div>
        </div>

        <div class="d-grid">
            <button class="btn btn-primary fw-semibold" type="submit">Login</button>
        </div>
    </form>

    <p class="text-muted fs-14 mb-0" hidden>Login sebagai?
        <a href="auth-register.php" class="fw-semibold text-danger ms-1">Siswa</a> |<a href="auth-register.php" class="fw-semibold text-danger ms-1">Orang Tua</a>
    </p>

</div>
@endsection

@section('javascript_custom')
<script>
    function togglePassword() {
        const passwordField = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        // Cek tipe input password
        if (passwordField.type === "password") {
            passwordField.type = "text"; // Ubah jadi text agar bisa terlihat
            eyeIcon.classList.remove('ri-eye-off-fill'); // Ganti ikon
            eyeIcon.classList.add('ri-eye-fill'); // Tampilkan ikon mata terbuka
        } else {
            passwordField.type = "password"; // Kembali ke password
            eyeIcon.classList.remove('ri-eye-fill'); // Ganti ikon
            eyeIcon.classList.add('ri-eye-off-fill'); // Tampilkan ikon mata tertutup
        }
    }
</script>
@endsection