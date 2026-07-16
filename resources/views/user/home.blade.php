@extends('layout.user')

@section('content')
<div class="hero-section position-relative overflow-hidden d-flex align-items-center" style="min-height: 85vh; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    <div class="container position-relative z-1 text-white">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 text-center text-lg-start">
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-3 shadow-sm tracking-wider" style="font-size: 0.8rem;">Premium Car Rental</span>
                <h1 class="display-4 fw-extrabold lh-tight mb-3 text-white">
                    Solusi Perjalanan <span class="text-warning">Aman & Nyaman</span> Untuk Anda
                </h1>
                <p class="lead text-white-50 mb-4 fs-5" style="max-width: 540px;">
                    Dapatkan pengalaman berkendara terbaik dengan pilihan armada prima, terawat, dan harga transparan tanpa biaya tersembunyi.
                </p>
                <div class="d-sm-flex justify-content-center justify-content-lg-start gap-3">
                    <a href="/armada" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-3 shadow-lg hover-scale mb-3 mb-sm-0">
                        <i class="bi bi-car-front-fill me-2"></i>Lihat Pilihan Armada
                    </a>
                    <a href="#tentang-kami" class="btn btn-outline-light btn-lg fw-semibold px-4 py-3 rounded-3 hover-bg-white mb-3 mb-sm-0">
                        Pelajari Selengkapnya
                    </a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block text-center position-relative">
                <div class="position-absolute top-50 start-50 translate-middle bg-white opacity-10 rounded-circle" style="width: 450px; height: 450px; filter: blur(30px);"></div>
                <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&q=80&w=800" class="img-fluid rounded-4 shadow-2xl position-relative z-2 transform-image border border-white border-opacity-10" alt="Premium Car Showcase" style="max-height: 400px; object-fit: cover;">
            </div>
        </div>
    </div>
</div>

<div class="container position-relative z-3" style="margin-top: -50px;">
    <div class="bg-white rounded-4 shadow-lg p-4 text-center border">
        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-3 border-end-md">
                <h3 class="fw-bold text-primary mb-1">50+</h3>
                <small class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Armada Prima</small>
            </div>
            <div class="col-6 col-md-3 border-end-md">
                <h3 class="fw-bold text-primary mb-1">4.9/5</h3>
                <small class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Rating Pelanggan</small>
            </div>
            <div class="col-6 col-md-3 border-end-md">
                <h3 class="fw-bold text-primary mb-1">10k+</h3>
                <small class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Perjalanan Sukses</small>
            </div>
            <div class="col-6 col-md-3">
                <h3 class="fw-bold text-primary mb-1">24/7</h3>
                <small class="text-muted text-uppercase fw-semibold tracking-wider" style="font-size: 0.75rem;">Layanan Bantuan</small>
            </div>
        </div>
    </div>
</div>

<div class="container my-5 pt-5">
    <div class="text-center mb-5">
        <h6 class="text-primary fw-bold text-uppercase tracking-wider">Kemudahan Transaksi</h6>
        <h2 class="fw-bold text-dark">Cara Mudah Sewa Mobil</h2>
        <div class="mx-auto bg-primary rounded mt-2" style="width: 50px; height: 3px;"></div>
    </div>
    <div class="row g-4 text-center justify-content-center">
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-light border h-100 step-card">
                <div class="icon-shape bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                    <i class="bi bi-calendar2-check fs-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">1. Pilih Jadwal & Unit</h5>
                <p class="text-muted small mb-0">Tentukan tanggal sewa dan pilih unit mobil yang paling sesuai dengan kebutuhan akomodasi perjalanan Anda.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-light border h-100 step-card">
                <div class="icon-shape bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                    <i class="bi bi-person-lines-fill fs-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">2. Isi Data Diri</h5>
                <p class="text-muted small mb-0">Lengkapi data reservasi pada formulir pemesanan modern kami yang instan tanpa perlu repot membuat akun login.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="p-4 rounded-4 bg-light border h-100 step-card">
                <div class="icon-shape bg-primary text-white rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center shadow-sm" style="width: 60px; height: 60px;">
                    <i class="bi bi-key-fill fs-4"></i>
                </div>
                <h5 class="fw-bold text-dark mb-2">3. Ambil Kunci & Jalan</h5>
                <p class="text-muted small mb-0">Konfirmasi singkat oleh admin kami, lakukan pembayaran, dan armada siap Anda gunakan untuk berkendara nyaman.</p>
            </div>
        </div>
    </div>
</div>

<div id="tentang-kami" class="bg-light py-5 border-top border-bottom">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 text-center text-lg-start">
                <h6 class="text-primary fw-bold text-uppercase tracking-wider">Tentang Kami</h6>
                <h2 class="fw-bold text-dark mb-3">Mengapa Harus Memilih Rental Jaya?</h2>
                <p class="text-muted mb-4" style="line-height: 1.8;">
                    Kami memahami bahwa kenyamanan dan keselamatan perjalanan Anda adalah prioritas utama. Oleh karena itu, Rental Jaya hadir dengan standardisasi layanan tinggi untuk menjamin ketenangan pikiran Anda selama di perjalanan.
                </p>
                <a href="/armada" class="btn btn-outline-primary px-4 py-2.5 rounded-3 fw-semibold">Eksplorasi Katalog</a>
            </div>
            <div class="col-lg-7">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border h-100 feature-card">
                            <i class="bi bi-shield-check text-success fs-2 mb-3 d-block"></i>
                            <h6 class="fw-bold text-dark mb-2">Armada Selalu Prima & Bersih</h6>
                            <p class="text-muted small mb-0">Setiap armada melewati pengecekan mekanis berkala menyeluruh serta pembersihan sanitasi interior sebelum diserahterimakan.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border h-100 feature-card">
                            <i class="bi bi-tags text-primary fs-2 mb-3 d-block"></i>
                            <h6 class="fw-bold text-dark mb-2">Harga Transparan</h6>
                            <p class="text-muted small mb-0">Tarif sewa kompetitif yang tertera bersifat final dan jujur tanpa adanya biaya tambahan siluman saat pengembalian.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border h-100 feature-card">
                            <i class="bi bi-headset text-warning fs-2 mb-3 d-block"></i>
                            <h6 class="fw-bold text-dark mb-2">Layanan CS Responsif</h6>
                            <p class="text-muted small mb-0">Tim operasional front-office dan teknis kami siap memberikan dukungan darurat cepat tanggap kapan saja Anda butuhkan.</p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="bg-white p-4 rounded-4 shadow-sm border h-100 feature-card">
                            <i class="bi bi-lightning-charge text-danger fs-2 mb-3 d-block"></i>
                            <h6 class="fw-bold text-dark mb-2">Proses Instan</h6>
                            <p class="text-muted small mb-0">Sistem booking modern terintegrasi kalkulator otomatis mempermudah verifikasi administrasi sewa tanpa birokrasi berbelit.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media (min-width: 768px) {
        .border-end-md {
            border-end: none;
            border-right: 1px solid #dee2e6 !important;
        }
    }
    .hover-scale {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-scale:hover {
        transform: scale(1.03);
        box-shadow: 0 1rem 3rem rgba(0,0,0,0.175) !important;
    }
    .hover-bg-white:hover {
        background-color: rgba(255, 255, 255, 0.15) !important;
    }
    .transform-image {
        transition: transform 0.4s ease;
    }
    .transform-image:hover {
        transform: scale(1.02) rotate(1deg);
    }
    .step-card, .feature-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .step-card:hover, .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important;
    }
</style>
@endsection