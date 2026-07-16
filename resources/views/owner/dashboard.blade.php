<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard - Rental Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">👑 Rental Jaya - Owner Panel</a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm fw-semibold">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold">Laporan Ringkasan Bisnis</h2>
                <p class="text-muted">Selamat datang Owner, berikut data rekapitulasi performa rental jaya.</p>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-primary text-white p-4 rounded-3">
                    <small class="text-white-50 text-uppercase fw-bold">Total Pemasukan Finansial</small>
                    <h1 class="fw-bold mt-2">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm bg-success text-white p-4 rounded-3">
                    <small class="text-white-50 text-uppercase fw-bold">Jumlah Total Armada</small>
                    <h1 class="fw-bold mt-2">{{ $totalMobil }} Kendaraan</h1>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <h4 class="fw-bold text-dark mb-4">Daftar Riwayat Transaksi Rental</h4>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Penyewa</th>
                                <th>Mobil</th>
                                <th>Tgl Sewa</th>
                                <th>Tgl Kembali</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $index => $transaksi)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <!-- SESUAI DATABASE: nama_peminjam -->
                                <td class="fw-semibold text-capitalize">{{ $transaksi->nama_peminjam }}</td>
                                
                                <!-- Relasi model mobil -->
                                <td>{{ $transaksi->mobil->merek ?? 'Unit' }} {{ $transaksi->mobil->model ?? 'Dihapus' }}</td>
                                
                                <!-- SESUAI DATABASE: tanggal_sewa & tanggal_kembali -->
                                <td>{{ $transaksi->tanggal_sewa }}</td>
                                <td>{{ $transaksi->tanggal_kembali }}</td>
                                
                                <!-- SESUAI DATABASE: total_harga -->
                                <td class="fw-bold text-primary">
                                    Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                                </td>
                                <td>
                                    <!-- SESUAI DATABASE: status_transaksi (menggunakan underscore, bukan minus) -->
                                    <span class="badge {{ $transaksi->status_transaksi == 'Selesai' || $transaksi->status_transaksi == 'disewa' ? 'bg-success' : 'bg-warning' }}">
                                        {{ $transaksi->status_transaksi }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">Belum ada rekaman data transaksi masuk.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html>