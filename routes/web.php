<?php

use App\Http\Controllers\MobilController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LaporanController; // Tambahkan controller ini untuk laporan owner
use Illuminate\Support\Facades\Route;
use App\Models\Mobil;
use App\Models\Transaksi;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| 1. AKSES PUBLIK / USER UMUM (Bebas Akses Tanpa Login)
|--------------------------------------------------------------------------
*/

// Halaman utama langsung diarahkan ke katalog armada atau home user tanpa login portal
Route::get('/', function () {
    return redirect()->route('user.home');
});

// Halaman 1: Tentang Kami
Route::get('/home', function () {
    // Jika admin atau owner iseng buka halaman ini, biarkan saja atau bypass ke dashboard mereka
    if(auth()->check() && auth()->user()->role === 'admin') { return redirect()->route('dashboard'); }
    if(auth()->check() && auth()->user()->role === 'owner') { return redirect()->route('owner.dashboard'); }
    return view('user.home');
})->name('user.home');

// Halaman 2: Khusus Katalog Armada Mobil Mandiri (Bebas Tanpa Login)
Route::get('/armada', function () {
    if(auth()->check() && auth()->user()->role === 'admin') { return redirect()->route('dashboard'); }
    if(auth()->check() && auth()->user()->role === 'owner') { return redirect()->route('owner.dashboard'); }
    
    $mobils = Mobil::all(); // Mengambil seluruh data mobil langsung ke view umum
    return view('user.armada', compact('mobils'));
})->name('user.armada');

// Form rental untuk user umum (tanpa login)
Route::get('/rental/form/{mobil_id}', function ($mobil_id) {
    try {
        $realId = Crypt::decryptString($mobil_id);
        $mobil = App\Models\Mobil::findOrFail($realId);
        return view('user.rental_form', compact('mobil'));
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        // Jika ada orang iseng mengubah isi string URL secara asal, lempar ke halaman 404 (Not Found)
        abort(404);
    }
})->name('rental.form');

// ✅ DIUPDATE: Route rental.kirim - Simpan ke database dan redirect
Route::post('/rental/kirim/{mobil_id}', [TransaksiController::class, 'storeFromPublic'])->name('rental.kirim');

Route::middleware(['auth', 'verified'])->group(function () {
    
    /* --- HAK AKSES: ADMIN ONLY --- */
    Route::get('/dashboard', function () {
        // Jika yang login ternyata Owner, tendang ke dashboard owner
        if(auth()->user()->role === 'owner') {
            return redirect()->route('owner.dashboard');
        }
        // Jika yang login bukan admin, tendang ke luar
        if(auth()->user()->role !== 'admin') {
            return redirect()->route('user.home');
        }

        $totalMobil = Mobil::count();
        $mobilTersedia = Mobil::where('status', 'tersedia')->count();
        $mobilDisewa = Mobil::where('status', 'disewa')->count();
        $totalTransaksi = Transaksi::count();

        return view('dashboard', compact('totalMobil', 'mobilTersedia', 'mobilDisewa', 'totalTransaksi'));
    })->name('dashboard');

    // Route CRUD Mobil (Hanya Admin)
    Route::resource('mobil', MobilController::class)->middleware(\App\Http\Middleware\EnsureUserHasRole::class . ':admin');
    
    // Route CRUD Transaksi (Hanya Admin yang kelola)
    Route::resource('transaksi', TransaksiController::class)->middleware(\App\Http\Middleware\EnsureUserHasRole::class . ':admin');
    
    
    /* --- HAK AKSES: OWNER ONLY (Entitas Baru Tuntutan Dosen) --- */
    // Memakai middleware EnsureUserHasRole bawaan proyekmu dengan parameter ':owner'
    Route::middleware(\App\Http\Middleware\EnsureUserHasRole::class . ':owner')->group(function () {
        Route::get('/owner/dashboard', [LaporanController::class, 'ownerDashboard'])->name('owner.dashboard');
    });


    /* --- Profile (Bawaan Breeze, opsional jika ingin dipertahankan) --- */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute login & logout bawaan Laravel Breeze
require __DIR__.'/auth.php';