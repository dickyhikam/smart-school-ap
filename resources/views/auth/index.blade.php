@extends('layouts.auth')

@section('title', $nama_menu)

@section('content')

<div class="card overflow-hidden text-center p-xxl-4 p-3 mb-0">

    <h4 class="fw-semibold mb-3 fs-18">Log in ke akun Anda</h4>

    <form action="index.php" class="text-start mb-3">
        <div class="mb-3">
            <label class="form-label" for="example-email">NIP/NIS</label>
            <input id="example-email" name="example-email" class="form-control" placeholder="Masukkan NIP/NIS anda">
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="password" id="example-password" class="form-control" placeholder="Masukkan password anda">
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