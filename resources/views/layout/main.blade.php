<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental Jaya - Tugas Akhir</title>
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Mengatur transparansi default teks menu non-aktif agar tidak terlalu mencolok */
    .navbar-nav .nav-link.custom-nav-item {
        color: rgba(255, 255, 255, 0.75) !important;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
    }

    /* Efek HOVER: Saat kursor diarahkan, teks jadi putih tegas, background putih super tipis */
    .navbar-nav .nav-link.custom-nav-item:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.08); /* Jauh lebih tipis dari yang tadi */
    }
    .navbar-nav .nav-link.active-nav {
        color: #ffffff !important;
        background-color: transparent !important; /* Kita hapus background putih tebalnya */
        border-bottom: 2px solid #ffffff; /* Penanda halaman aktif diganti garis bawah putih minimalis */
        border-radius: 0px !important;
    }
</style>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm mb-4" style="background: linear-gradient(135deg, #3a7bd5 0%, #3a6073 100%);">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 text-white" href="{{ route('dashboard') }}">
            <i class="bi bi-car-front-fill me-2"></i>Rental Jaya
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto gap-1">
                <a class="nav-link px-3 rounded text-white custom-nav-item {{ Request::is('dashboard') ? 'active active-nav' : '' }}" 
                   href="{{ route('dashboard') }}">Dashboard</a>

                <a class="nav-link px-3 rounded text-white custom-nav-item {{ Request::is('mobil*') ? 'active active-nav' : '' }}" 
                   href="{{ route('mobil.index') }}">Data Mobil</a>

                <a class="nav-link px-3 rounded text-white custom-nav-item {{ Request::is('transaksi*') ? 'active active-nav' : '' }}" 
                   href="{{ route('transaksi.index') }}">Transaksi Rental</a>
                
                <form method="POST" action="{{ route('logout') }}" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm px-3 py-2 fw-semibold shadow-sm text-white border-0" 
                            onclick="return confirm('Yakin ingin keluar?')">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    </nav>

    <div class="container">
    
        @yield('content')
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>