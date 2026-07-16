@extends('layout.user')

@section('content')
<!-- BACKGROUND BAGIAN LUAR FORM MENGGUNAKAN OFF-WHITE SEPERTI ARMAda -->
<div class="py-5" style="background-color: #f4f7f6; min-height: 85vh; display: flex; align-items: center;">
    <div class="container d-flex justify-content-center">
        <div class="card shadow-lg border-0 rounded-4 overflow-hidden w-100" style="max-width: 600px; border-top: 5px solid #1e3c72 !important;">
            
            <!-- Header Menggunakan Gradasi Blue Sesuai Home -->
            <div class="card-header text-white text-center py-4 border-0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
                <h4 class="fw-bold mb-0 text-uppercase tracking-wide" style="font-size: 1.25rem;">Form Pemesanan Rental Mobil</h4>
                <p class="mb-0 text-white-50 small">Lengkapi data reservasi unit untuk proses selanjutnya</p>
            </div>
            
            <div class="card-body p-4 p-md-5 bg-white">
                
                <!-- Info Ringkas Mobil -->
                <div class="d-flex align-items-center p-3 rounded-3 mb-4 border" style="background-color: #f8fafc; border-left: 4px solid #1e3c72 !important;">
                    @if($mobil->gambar)
                        <img src="{{ asset('uploads/mobil/' . $mobil->gambar) }}" class="rounded shadow-sm me-3" style="width: 80px; height: 50px; object-fit: cover;">
                    @else
                        <div class="rounded shadow-sm me-3 bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 50px;">
                            <i class="bi bi-car-front" style="font-size: 2rem; color: #ccc;"></i>
                        </div>
                    @endif
                    <div>
                        <h6 class="fw-bold text-dark mb-0" style="color: #1e3c72 !important;">{{ $mobil->merek }} {{ $mobil->model }}</h6>
                        <small class="text-muted">Tarif Sewa: <strong class="text-primary">Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</strong> / hari</small>
                    </div>
                </div>

                <!-- ✅ DIUPDATE: Form action ke route rental.kirim dengan parameter enkripsi -->
                <form id="rentalForm" action="{{ route('rental.kirim', Crypt::encryptString($mobil->id)) }}" method="POST">
                    @csrf
                    <input type="hidden" id="hargaPerHari" value="{{ $mobil->harga_per_hari }}">

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                            <input type="text" name="nama" class="form-control rounded-end-3 border-start-0 custom-input" placeholder="Masukkan nama sesuai KTP" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">No. Handphone (WhatsApp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-whatsapp"></i></span>
                            <input type="tel" name="no_hp" class="form-control rounded-end-3 border-start-0 custom-input" placeholder="Contoh: 0812345678xx" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-secondary small text-uppercase">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control rounded-end-3 border-start-0 custom-input" placeholder="nama@email.com" required>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Mulai Rental</label>
                            <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control rounded-3 custom-input" required min="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small text-uppercase">Selesai Rental</label>
                            <input type="date" id="tgl_selesai" name="tgl_selesai" class="form-control rounded-3 custom-input" required min="{{ date('Y-m-d') }}">
                        </div>
                    </div>

                    <!-- Box Live Estimasi Biaya Selaras dengan Tema -->
                    <div class="p-3 mb-4 text-center rounded-3 border" style="background-color: #f0f4f8; border-left: 4px solid #2a5298 !important;">
                        <small class="text-muted d-block mb-1 fw-medium">Estimasi Durasi & Akumulasi Biaya</small>
                        <h3 class="fw-extrabold mb-1" id="liveTotal" style="color: #1e3c72;">Rp 0</h3>
                        <span class="badge bg-secondary px-3 py-1.5 rounded-pill" id="liveHari">0 hari rental</span>
                    </div>

                    <div class="row g-3">
                        <div class="col-5">
                            <a href="{{ route('user.armada') }}" class="btn btn-light w-100 fw-bold py-2.5 rounded-3 border text-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                        <div class="col-7">
                            <button type="submit" class="btn text-white w-100 fw-bold py-2.5 rounded-3 shadow-sm btn-submit-premium">
                                <i class="bi bi-check2-circle me-1"></i> Kirim Pemesanan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- STYLING INPUT INTERAKTIF -->
<style>
    .custom-input {
        padding: 0.6rem 0.75rem;
        border: 1px solid #ced4da;
    }
    .custom-input:focus {
        border-color: #2a5298 !important;
        box-shadow: 0 0 0 0.25rem rgba(42, 82, 152, 0.15) !important;
    }
    .btn-submit-premium {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border: none;
        transition: all 0.2s ease;
    }
    .btn-submit-premium:hover {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        box-shadow: 0 4px 12px rgba(30, 60, 114, 0.25);
        color: #fff !important;
    }
    .fw-extrabold { font-weight: 800; }
</style>

<!-- Script Hitung Biaya Otomatis -->
<script>
    const tglMulai = document.getElementById('tgl_mulai');
    const tglSelesai = document.getElementById('tgl_selesai');
    const hargaPerHari = parseFloat(document.getElementById('hargaPerHari').value);
    const liveTotal = document.getElementById('liveTotal');
    const liveHari = document.getElementById('liveHari');

    function hitungTotal() {
        if (tglMulai.value && tglSelesai.value) {
            const start = new Date(tglMulai.value);
            const end = new Date(tglSelesai.value);
            
            const diffTime = end - start;
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;

            if (diffDays > 0) {
                const totalBiaya = diffDays * hargaPerHari;
                liveTotal.innerText = "Rp " + totalBiaya.toLocaleString('id-ID');
                liveHari.innerText = diffDays + " hari rental";
                liveHari.className = "badge bg-primary px-3 py-1.5 rounded-pill shadow-sm";
            } else {
                liveTotal.innerText = "Rp 0";
                liveHari.innerText = "Tanggal tidak valid";
                liveHari.className = "badge bg-danger px-3 py-1.5 rounded-pill shadow-sm";
            }
        }
    }

    tglMulai.addEventListener('change', hitungTotal);
    tglSelesai.addEventListener('change', hitungTotal);
</script>
@endsection