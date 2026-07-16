@extends('layout.main')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white fw-bold py-3">
                    Tambah Mobil Baru
                </div>
                <div class="card-body p-4">
                    
                    <!-- Alert Error Validasi -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- PENTING: Harus ada enctype="multipart/form-data" untuk upload foto -->
                    <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- 1. Merek Mobil -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Merek Mobil</label>
                            <input type="text" name="merek" class="form-control" placeholder="Contoh: Toyota, Honda, Daihatsu" value="{{ old('merek') }}" required>
                        </div>

                        <div class="mb-3">
                             <label class="form-label fw-semibold">Model / Tipe</label>
                             <input type="text" name="model" class="form-control" placeholder="Contoh: Avanza, Civic, Xenia" value="{{ old('model') }}" required>
                        </div>

                        <!-- 2. Nomor Polisi / Plat Nomor (WAJIB name="plat_nomor") -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nomor Polisi (Nopol / Plat)</label>
                            <input type="text" name="nopol" class="form-control" placeholder="Contoh: B 1234 ABC" value="{{ old('plat_nomor') }}" required>
                        </div>

                        <!-- 3. Harga Sewa Per Hari (WAJIB name="harga_sewa") -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Harga Sewa Per Hari (Rp)</label>
                            <input type="number" name="harga_per_hari" class="form-control" placeholder="Contoh: 350000" value="{{ old('harga_sewa') }}" required>
                        </div>

                        <!-- 4. Status Mobil (WAJIB name="status") -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Status Awal Mobil</label>
                            <select name="status" class="form-select" required>
                                <option value="tersedia" {{ old('status') == 'tersedia' ? 'selected' : '' }}>Tersedia (Siap Disewa)</option>
                                <option value="disewa" {{ old('status') == 'disewa' ? 'selected' : '' }}>Sedang Disewa</option>
                            </select>
                        </div>

                        <!-- 5. Upload Berkas Foto Mobil (WAJIB name="gambar") -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Foto Mobil</label>
                            <input type="file" name="gambar" class="form-control">
                            <small class="text-muted d-block mt-1">Format: jpg, jpeg, png (Max: 2MB). Kosongkan jika tidak ada foto.</small>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success px-4 fw-semibold">Simpan Data Mobil</button>
                            <a href="{{ route('mobil.index') }}" class="btn btn-secondary px-4">Batal</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection