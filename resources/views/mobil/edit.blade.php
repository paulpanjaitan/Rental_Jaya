@extends('layout.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-warning text-dark">Edit Data Mobil</div>
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

                <form action="{{ route('mobil.update', $mobil->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Merek Mobil</label>
                        <input type="text" name="merek" class="form-control" value="{{ $mobil->merek }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Model / Tipe</label>
                        <input type="text" name="model" class="form-control" value="{{ $mobil->model }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nomor Polisi (Nopol)</label>
                        <input type="text" name="nopol" class="form-control" value="{{ $mobil->nopol }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Sewa Per Hari (Rp)</label>
                        <input type="number" name="harga_per_hari" class="form-control" value="{{ $mobil->harga_per_hari }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Mobil</label>
                        <select name="status" class="form-select" required>
                            <option value="tersedia" {{ $mobil->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="disewa" {{ $mobil->status == 'disewa' ? 'selected' : '' }}>Disewa</option>
                        </select>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <a href="{{ route('mobil.index') }}" class="btn btn-secondary w-50">Kembali</a>
                        <button type="submit" class="btn btn-success w-50">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection