@extends('layout.user')

@section('content')

<!-- ✅ SUCCESS POPUP MODAL DENGAN BACKDROP (Muncul di depan) -->
@if(session('success'))
<!-- Backdrop Overlay -->
<div class="position-fixed top-0 start-0 w-100 h-100" id="successBackdrop" style="background-color: rgba(0, 0, 0, 0.5); z-index: 1040; animation: fadeIn 0.3s ease;"></div>

<!-- Modal Popup -->
<div class="position-fixed top-50 start-50 translate-middle" id="successModal" style="z-index: 1050; animation: slideIn 0.3s ease;">
    <div class="card shadow-lg border-0 rounded-4" style="width: 420px; background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%); box-shadow: 0 20px 60px rgba(30, 60, 114, 0.4);">
        <div class="card-body text-center text-white py-5 px-4">
            <div class="mb-3">
                <div class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width: 80px; height: 80px; background-color: rgba(255, 255, 255, 0.2);">
                    <i class="bi bi-check-circle" style="font-size: 3.5rem; color: #4ade80;"></i>
                </div>
            </div>
            <h5 class="fw-bold mb-2" style="font-size: 1.3rem;">Pemesanan Berhasil! 🎉</h5>
            <p class="mb-0 small" style="font-size: 0.95rem; line-height: 1.5;">{{ session('success') }}</p>
            <div class="mt-4">
                <small class="text-white-50">Popup akan hilang dalam beberapa detik...</small>
            </div>
        </div>
    </div>
</div>
@endif

<!-- BANNER KECIL PENYELARAS TEMA -->
<div class="py-5 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/cubes.png');"></div>
    <div class="container position-relative z-1 text-center py-3">
        <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill text-uppercase mb-2 shadow-sm" style="font-size: 0.75rem; tracking-wider: 1px;">Katalog Unit</span>
        <h2 class="fw-extrabold text-uppercase tracking-wide mb-1">Pilihan Armada Mobil</h2>
        <p class="text-white-50 fs-6 mb-0">Daftar kendaraan terbaik kami yang siap menemani perjalanan aman Anda hari ini.</p>
        <div class="mx-auto bg-warning rounded mt-3" style="width: 60px; height: 3px;"></div>
    </div>
</div>

<!-- SEKSI KATALOG DENGAN BACKGROUND OFF-WHITE MODERN -->
<div class="py-5" style="background-color: #f4f7f6; min-height: 50vh;">
    <div class="container">
        <div class="row g-4">
            @forelse($mobils as $mobil)
                <!-- Pas 4 Card dalam 1 baris di layar desktop -->
                <div class="col-lg-3 col-md-6">
                    <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden position-relative car-evaluation-card">
                        
                        <!-- Badge Status Mengapung -->
                        <span class="position-absolute top-0 start-0 m-3 badge {{ $mobil->status == 'tersedia' ? 'bg-success text-white' : 'bg-danger text-white' }} text-uppercase px-3 py-2 rounded-pill shadow-sm small fw-bold z-3" style="font-size: 0.7rem;">
                            <i class="bi {{ $mobil->status == 'tersedia' ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }} me-1"></i> {{ $mobil->status }}
                        </span>
                        
                        <!-- Wrapper Gambar -->
                        <div class="img-wrapper overflow-hidden bg-light position-relative">
                            @if($mobil->gambar)
                                <img src="{{ asset('uploads/mobil/' . $mobil->gambar) }}" class="card-img-top car-img" alt="{{ $mobil->merek }}" style="height: 170px; object-fit: cover;">
                            @else
                                <div class="d-flex align-items-center justify-content-center text-secondary" style="height: 170px;">
                                    <i class="bi bi-car-front" style="font-size: 4rem;"></i>
                                </div>
                            @endif
                        </div>

                        <div class="card-body d-flex flex-column justify-content-between p-4 bg-white">
                            <div>
                                <h5 class="card-title fw-bold text-dark mb-1 text-truncate" style="color: #1e3c72 !important;">
                                    {{ $mobil->merek }} {{ $mobil->model }}
                                </h5>
                                <p class="text-muted small mb-3">
                                    <span class="bg-light px-2 py-1 rounded border text-dark">
                                        <i class="bi bi-credit-card-2-front text-secondary me-1"></i>{{ $mobil->nopol }}
                                    </span>
                                </p>
                            </div>
                            
                            <div class="pt-3 border-top mt-2">
                                <!-- Box Harga -->
                                <div class="p-3 rounded-3 mb-3" style="background-color: #f0f4f8; border-left: 4px solid #2a5298;">
                                    <small class="text-muted d-block" style="font-size: 0.75rem;">Tarif Sewa:</small>
                                    <div class="d-flex align-items-baseline">
                                        <span class="fw-extrabold fs-4" style="color: #1e3c72;">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</span>
                                        <small class="text-muted ms-1" style="font-size: 0.8rem;">/ hari</small>
                                    </div>
                                </div>
                                
                                @if($mobil->status == 'tersedia')
                                    <a href="{{ route('rental.form', Crypt::encryptString($mobil->id)) }}" class="btn text-white w-100 fw-bold rounded-3 py-2.5 shadow-sm btn-sewa-premium">
                                        <i class="bi bi-calendar-plus me-1"></i> Sewa Mobil
                                    </a>
                                @else
                                    <button class="btn btn-secondary w-100 fw-semibold rounded-3 py-2.5 text-white-50" disabled>Tidak Tersedia</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-1 mb-2">🚗</div>
                    <p class="text-muted fw-medium">Belum ada armada mobil yang didaftarkan oleh admin.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<!-- STYLE CUSTOM -->
<style>
    .car-evaluation-card {
        transition: transform 0.3s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.3s ease;
        border: 1px solid rgba(0,0,0,0.03) !important;
    }
    .car-evaluation-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 30px rgba(30, 60, 114, 0.12) !important;
    }
    .img-wrapper .car-img {
        transition: transform 0.5s ease;
    }
    .car-evaluation-card:hover .car-img {
        transform: scale(1.06);
    }
    .btn-sewa-premium {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border: none;
    }
    .btn-sewa-premium:hover {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        box-shadow: 0 4px 12px rgba(30, 60, 114, 0.3);
        color: #fff !important;
    }
    .z-3 { z-index: 3; }
    .fw-extrabold { font-weight: 800; }

    /* ✅ ANIMASI POPUP SUCCESS */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.85);
        }
        to {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
    }
    
    @keyframes slideOut {
        from {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        to {
            opacity: 0;
            transform: translate(-50%, -50%) scale(0.85);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
        }
        to {
            opacity: 0;
        }
    }
    
    #successModal.fade-out {
        animation: slideOut 0.4s ease forwards;
    }

    #successBackdrop.fade-out {
        animation: fadeOut 0.4s ease forwards;
    }
</style>

<!-- ✅ SCRIPT UNTUK AUTO-HIDE SUCCESS MODAL DENGAN BACKDROP -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const successModal = document.getElementById('successModal');
        const successBackdrop = document.getElementById('successBackdrop');
        
        if (successModal) {
            // Auto-hide setelah 4 detik
            setTimeout(function() {
                // Fade out modal dan backdrop
                successModal.classList.add('fade-out');
                if (successBackdrop) {
                    successBackdrop.classList.add('fade-out');
                }
                
                // Tunggu animasi selesai, baru hapus dan scroll ke atas
                setTimeout(function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    successModal.remove();
                    if (successBackdrop) {
                        successBackdrop.remove();
                    }
                }, 400);
            }, 4000);
        }
    });
</script>

@endsection