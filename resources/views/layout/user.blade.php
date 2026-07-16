<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Jaya - Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(135deg, #3a7bd5 0%, #3a6073 100%);
            color: white;
            padding: 80px 0;
        }
        .footer-link {
        transition: color 0.2s ease-in-out, padding-left 0.2s ease-in-out;
        }
        .footer-link:hover {
            color: #0d6efd !important; /* Berubah warna ke biru primary */
            padding-left: 4px;
        }
        .social-icon {
            transition: background-color 0.2s, border-color 0.2s;
        }
        .social-icon:hover {
            background-color: #0d6efd !important;
            border-color: #0d6efd !important;
        }
    </style>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/home"><i class="bi bi-car-front-fill me-2"></i>Rental Jaya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavUser">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavUser">
            <div class="navbar-nav ms-auto gap-2 align-items-center">
                <a class="nav-link {{ Request::is('home') ? 'text-white fw-bold' : 'text-white-50' }}" href="/home">Tentang Kami</a>
                <a class="nav-link {{ Request::is('armada') ? 'text-white fw-bold' : 'text-white-50' }}" href="/armada">Armada Mobil</a>
                
                {{-- Modifikasi Tombol Autentikasi Mengikuti Logika Baru Bebas Akses (Aturan Dosen) --}}
                @if(Auth::check())
                    {{-- Jika ada yang login (Misalnya Admin/Owner sedang mengecek halaman depan) --}}
                    @if(Auth::user()->role === 'admin')
                        <a class="nav-link text-warning-50" href="{{ route('dashboard') }}">Dashboard Admin</a>
                    @elseif(Auth::user()->role === 'owner')
                        <a class="nav-link text-warning-50" href="{{ route('owner.dashboard') }}">Laporan Owner</a>
                    @endif
                    
                    <span class="text-info mx-2 fw-semibold">Halo, {{ Auth::user()->name }}!</span>
                    
                    <form method="POST" action="{{ route('logout') }}" class="m-0 d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm px-3" onclick="return confirm('Yakin ingin logout?')">Logout</button>
                    </form>
                @else
                    {{-- Jika pengunjung umum/tamu biasa yang datang tanpa login (Default Publik) --}}
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login Portal
                    </a>
                @endif
            </div>
        </div>
        
    </div>
</nav>

<main style="flex: 1 0 auto;">
@yield('content')
</main>

<footer class="bg-dark text-white pt-5 pb-4 mt-auto border-top border-secondary border-opacity-25 shadow-lg">
    <div class="container text-md-start text-center">
        <div class="row text-md-start text-center justify-content-between">
            
            <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mb-4">
                <h5 class="text-uppercase fw-bold text-primary mb-4">
                    <i class="bi bi-car-front-fill me-2"></i>Rental Jaya
                </h5>
                <p class="text-white-50 small" style="line-height: 1.8;">
                    Penyedia layanan sewa mobil terbaik dan terpercaya. Kami berkomitmen memberikan armada prima dan pelayanan profesional untuk kenyamanan perjalanan Anda.
                </p>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                <h6 class="text-uppercase fw-bold text-white mb-4 border-bottom border-primary pb-2 d-inline-block" style="border-width: 2px !important;">
                    Navigasi
                </h6>
                <p class="mb-2">
                    <a href="/home" class="text-white-50 text-decoration-none footer-link">Tentang Kami</a>
                </p>
                <p class="mb-2">
                    <a href="/armada" class="text-white-50 text-decoration-none footer-link">Armada Mobil</a>
                </p>
                <p class="mb-2">
                    <a href="{{ route('login') }}" class="text-white-50 text-decoration-none footer-link">Portal Login</a>
                </p>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <h6 class="text-uppercase fw-bold text-white mb-4 border-bottom border-primary pb-2 d-inline-block" style="border-width: 2px !important;">
                    Hubungi Kami
                </h6>
                <p class="text-white-50 mb-3 small">
                    <i class="bi bi-geo-alt-fill text-primary me-2"></i> Kota Jambi, Indonesia
                </p>
                <div class="d-flex justify-content-md-start justify-content-center gap-3">
                    <a href="https://instagram.com/rentaljaya" target="_blank" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm social-icon" style="width: 36px; height: 36px;">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://tiktok.com/@rentaljaya" target="_blank" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm social-icon" style="width: 36px; height: 36px;">
                        <i class="bi bi-tiktok"></i>
                    </a>
                    <a href="https://wa.me/628127400xxxx" target="_blank" class="btn btn-outline-light btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm social-icon" style="width: 36px; height: 36px;">
                        <i class="bi bi-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>

        <hr class="my-4 border-secondary border-opacity-50">

        <div class="row align-items-center">
            <div class="col-md-12 text-center">
                <p class="mb-0 small text-white-50">&copy; 2026 <span class="text-primary fw-semibold">Rental Jaya</span> - Made With Love By :</p>
                <p class="mb-0 small text-white-50">Paul Panjaitan</p>
                <p class="mb-0 small text-white-50">Ramadhani Ahmad</p>
                <p class="mb-0 small text-white-50">Delvio Pasha Mandala</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>