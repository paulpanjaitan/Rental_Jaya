<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Portal - Rental Jaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #3a7bd5 0%, #3a6073 100%); height: 100vh; }
        .card { border: none; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); }
        .nav-pills .nav-link.active { background-color: #dc3545; } /* Default active ke Admin (Merah) */
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card p-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <h3 class="fw-bold text-primary">RENTAL JAYA</h3>
                        <p class="text-muted" id="login-title">Silakan masuk ke akun Admin Utama</p>
                    </div>

                    {{-- Menampilkan Pesan Error Validasi --}}
                    @if ($errors->any())
                        <div class="alert alert-danger py-2">
                            <ul class="mb-0 fs-6">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Tab Opsi Pilihan Login Antara Admin vs Owner (Aturan Dosen No. 4) --}}
                    <ul class="nav nav-pills nav-justified mb-4" id="roleTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-semibold" id="admin-tab" onclick="setRole('admin')">Login as Admin</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-semibold" id="owner-tab" onclick="setRole('owner')">Login as Owner</button>
                        </li>
                    </ul>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        {{-- Input Hidden untuk mengirimkan jenis role yang dipilih ke backend Auth Controller --}}
                        <input type="hidden" name="role_type" id="role_type" value="admin">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Alamat Email</label>
                            <input type="email" name="email" class="form-control" placeholder="nama@rentaljaya.com" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-danger w-100 fw-bold py-2 mb-3" id="btn-submit">LOG IN SEBAGAI ADMIN</button>
                    </form>

                    <div class="text-center">
                        <a href="{{ route('user.armada') }}" class="text-decoration-none small text-secondary">← Kembali ke Katalog Armada</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function setRole(role) {
        document.getElementById('role_type').value = role;
        
        const adminTab = document.getElementById('admin-tab');
        const ownerTab = document.getElementById('owner-tab');
        const loginTitle = document.getElementById('login-title');
        const btnSubmit = document.getElementById('btn-submit');

        // Modifikasi Style Lembaran Style Aktif Nav-Pills secara dinamis
        const styleElement = document.querySelector('style');

        if(role === 'admin') {
            ownerTab.classList.remove('active');
            adminTab.classList.add('active');
            
            // Ubah rule warna background aktif tombol tab menjadi Merah (Admin)
            styleElement.innerHTML = styleElement.innerHTML.replace('.nav-pills .nav-link.active { background-color: #0d6efd; }', '.nav-pills .nav-link.active { background-color: #dc3545; }');
            
            loginTitle.innerText = "Silakan masuk ke akun Admin Utama";
            btnSubmit.innerText = "LOG IN SEBAGAI ADMIN";
            btnSubmit.className = "btn btn-danger w-100 fw-bold py-2 mb-3";
        } else {
            adminTab.classList.remove('active');
            ownerTab.classList.add('active');
            
            // Ubah rule warna background aktif tombol tab menjadi Biru (Owner)
            styleElement.innerHTML = styleElement.innerHTML.replace('.nav-pills .nav-link.active { background-color: #dc3545; }', '.nav-pills .nav-link.active { background-color: #0d6efd; }');
            
            loginTitle.innerText = "Silakan masuk ke panel pemantauan Owner";
            btnSubmit.innerText = "LOG IN SEBAGAI OWNER";
            btnSubmit.className = "btn btn-primary w-100 fw-bold py-2 mb-3";
        }
    }
</script>
</body>
</html>