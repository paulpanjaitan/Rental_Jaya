@extends('layout.main')

@section('content')
<div class="mb-4">
    <h2 class="fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-muted">Berikut adalah ringkasan informasi sistem Rental Jaya hari ini.</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75">Total Armada</h6>
                <h2 class="fw-bold mb-0">{{ $totalMobil }} <span class="fs-5 fw-normal">Mobil</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-success text-white border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75">Mobil Tersedia</h6>
                <h2 class="fw-bold mb-0">{{ $mobilTersedia }} <span class="fs-5 fw-normal">Unit</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-danger text-white border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75">Sedang Disewa</h6>
                <h2 class="fw-bold mb-0">{{ $mobilDisewa }} <span class="fs-5 fw-normal">Unit</span></h2>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card bg-warning text-dark border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="text-uppercase mb-2 opacity-75">Total Transaksi</h6>
                <h2 class="fw-bold mb-0">{{ $totalTransaksi }} <span class="fs-5 fw-normal">Sewa</span></h2>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white py-3 fw-semibold">
        Akses Cepat Sistem Informasi
    </div>
    <div class="card-body p-4">
        <p>Silakan gunakan menu navigasi di atas atau tombol di bawah ini untuk mengelola data aplikasi:</p>
        <div class="d-flex gap-2">
            <a href="{{ route('mobil.index') }}" class="btn btn-outline-primary">Kelola Data Mobil</a>
            <a href="{{ route('transaksi.index') }}" class="btn btn-outline-success">Kelola Transaksi Rental</a>
        </div>
    </div>
</div>
@endsection