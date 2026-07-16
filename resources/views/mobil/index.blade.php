@extends('layout.main')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Armada Mobil</h3>
    <a href="{{ route('mobil.create') }}" class="btn btn-primary">Tambah Mobil Baru</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Merek</th>
                    <th>Model</th>
                    <th>No. Polisi</th>
                    <th>Harga / Hari</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mobils as $index => $mobil)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $mobil->merek }}</td>
                    <td>{{ $mobil->model }}</td>
                    <td><span class="badge bg-secondary">{{ $mobil->nopol }}</span></td>
                    <td>Rp {{ number_format($mobil->harga_per_hari, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $mobil->status == 'tersedia' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($mobil->status) }}
                        </span>
                    </td>

                    <td>
                        <a href="{{ route('mobil.edit', $mobil->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('mobil.destroy', $mobil->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus mobil ini?')">
                      @csrf
                     @method('DELETE')
                     <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                     </form>
                  </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data mobil.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection