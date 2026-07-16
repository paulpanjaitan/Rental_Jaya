@extends(Auth::user()->role === 'admin' ? 'layout.main' : 'layout.user')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Transaksi Rental</h3>
    @if(Auth::user()->role === 'admin')
        <span class="text-muted">Mode Monitor Admin</span>
    @else
    <a href="{{ route('transaksi.create') }}" class="btn btn-primary">Input Transaksi Baru</a>
    @endif
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Penyewa</th>
                    <th>Mobil</th>
                    <th>Tgl Sewa</th>
                    <th>Tgl Kembali</th>
                    <th>Total Bayar</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaksi->nama_peminjam }}</td>
                    <td>{{ $transaksi->mobil->merek }} {{ $transaksi->mobil->model }} ({{ $transaksi->mobil->nopol }})</td>
                    <td>{{ $transaksi->tanggal_sewa }}</td>
                    <td>{{ $transaksi->tanggal_kembali }}</td>
                    <td>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $transaksi->status_transaksi == 'proses' ? 'bg-warning text-dark' : 'bg-success' }}">
                            {{ ucfirst($transaksi->status_transaksi) }}
                        </span>
                    </td>
                    <td>
                        @if($transaksi->status_transaksi == 'proses')
                        <!-- ✅ DIUBAH: Tombol Pengembalian dengan SweetAlert2 -->
                        <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="confirmReturn({{ $transaksi->id }})">Pengembalian</a>
                        @else
                        <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted">Belum ada transaksi.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ✅ IMPORT SWEETALERT2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ✅ SCRIPT SWEETALERT2 UNTUK DIALOG PENGEMBALIAN -->
<script>
    function confirmReturn(transaksiId) {
        Swal.fire({
            title: 'Konfirmasi Pengembalian Mobil',
            text: 'Apakah Anda yakin mobil sudah dikembalikan oleh penyewa?',
            icon: 'question',
            iconColor: '#1e3c72',
            background: '#fff',
            backdrop: 'rgba(30, 60, 114, 0.4)',
            html: `
                <div style="text-align: left; margin-top: 15px;">
                    <p style="margin-bottom: 10px; font-size: 0.95rem;">
                        <i class="bi bi-info-circle" style="color: #2a5298; margin-right: 8px;"></i>
                        <strong>Catatan:</strong>
                    </p>
                    <ul style="text-align: left; padding-left: 25px; font-size: 0.9rem; color: #555;">
                        <li>Proses ini akan mengubah status transaksi menjadi <strong>SELESAI</strong></li>
                        <li>Mobil akan kembali ke status <strong>TERSEDIA</strong></li>
                        <li>Tindakan ini tidak dapat dibatalkan</li>
                    </ul>
                </div>
            `,
            showCancelButton: true,
            confirmButtonColor: '#2a5298',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="bi bi-check2-circle"></i> Ya, Selesaikan Transaksi',
            cancelButtonText: 'Batal',
            buttonsStyling: true,
            didOpen: (modal) => {
                // Style tombol
                const confirmBtn = modal.querySelector('.swal2-confirm');
                const cancelBtn = modal.querySelector('.swal2-cancel');
                
                confirmBtn.style.borderRadius = '6px';
                confirmBtn.style.fontWeight = '600';
                confirmBtn.style.padding = '10px 24px';
                
                cancelBtn.style.borderRadius = '6px';
                cancelBtn.style.fontWeight = '600';
                cancelBtn.style.padding = '10px 24px';
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirect ke route transaksi.show jika dikonfirmasi
                window.location.href = `{{ route('transaksi.show', '') }}/${transaksiId}`;
            }
        });
    }
</script>

<!-- ✅ STYLING SWEETALERT2 TAMBAHAN -->
<style>
    .swal2-popup {
        border-radius: 12px !important;
        box-shadow: 0 10px 40px rgba(30, 60, 114, 0.25) !important;
    }

    .swal2-title {
        color: #1e3c72 !important;
        font-size: 1.5rem !important;
        font-weight: 700 !important;
        margin-bottom: 15px !important;
    }

    .swal2-html-container {
        color: #333 !important;
        font-size: 1rem !important;
    }

    .swal2-confirm, .swal2-cancel {
        font-size: 0.95rem !important;
    }

    .swal2-confirm {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
        box-shadow: 0 4px 12px rgba(30, 60, 114, 0.2) !important;
    }

    .swal2-confirm:hover {
        background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%) !important;
        box-shadow: 0 6px 16px rgba(30, 60, 114, 0.3) !important;
    }

    .swal2-cancel {
        background-color: #6c757d !important;
        box-shadow: 0 2px 8px rgba(108, 117, 125, 0.15) !important;
    }

    .swal2-cancel:hover {
        background-color: #5a6268 !important;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.25) !important;
    }

    /* Icon styling */
    .swal2-icon.swal2-question {
        border-color: #2a5298 !important;
    }

    .swal2-icon.swal2-question [class^='swal2-icon-content']::before {
        color: #2a5298 !important;
    }
</style>

@endsection