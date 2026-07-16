@extends('layout.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">Input Transaksi Rental Baru</div>
            <div class="card-body">
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('transaksi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Pelanggan / Penyewa</label>
                        <input type="text" name="nama_peminjam" class="form-control" value="{{ Auth::user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pilih Mobil (Hanya yang Tersedia)</label>
                        <select name="mobil_id" class="form-select" required>
                            <option value="">-- Pilih Mobil --</option>
                            @foreach($mobils as $mobil)
                                <option value="{{ $mobil->id }}">{{ $mobil->merek }} {{ $mobil->model }} - Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}/hari</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Mulai Sewa</label>
                        <input type="date" name="tanggal_sewa" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tanggal Selesai Rental</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('transaksi.index') }}" class="btn btn-secondary w-50">Batal</a>
                        <button type="submit" class="btn btn-success w-50">Proses Rental</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection