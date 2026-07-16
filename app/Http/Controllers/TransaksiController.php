<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       if (auth()->user()->role === 'admin') {
        // Admin melihat seluruh transaksi di sistem
        $transaksis = Transaksi::with('mobil')->get();
     } else {
        // User/Pelanggan hanya melihat daftar transaksi miliknya sendiri
        $transaksis = Transaksi::with('mobil')->where('nama_peminjam', auth()->user()->name)->get();
      }
    
      return view('transaksi.index', compact('transaksis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mobils = Mobil::where('status', 'tersedia')->get();
        return view('transaksi.create', compact('mobils'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'mobil_id' => 'required',
            'nama_peminjam' => 'required',
            'tanggal_sewa' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_sewa',
        ]);

        // 1. Ambil data mobil untuk tahu harga per harinya
        $mobil = Mobil::findOrFail($request->mobil_id);

        // 2. Hitung durasi hari menggunakan Carbon
        $tglSewa = Carbon::parse($request->tanggal_sewa);
        $tglKembali = Carbon::parse($request->tanggal_kembali);
        $durasi = $tglSewa->diffInDays($tglKembali);
        
        // Jika pinjam dan kembali di hari yang sama, hitung 1 hari
        if($durasi == 0) {
            $durasi = 1;
        }

        // 3. Hitung total harga
        $totalHarga = $durasi * $mobil->harga_per_hari;

        // 4. Simpan transaksi
        Transaksi::create([
            'mobil_id' => $request->mobil_id,
            'nama_peminjam' => $request->nama_peminjam,
            'tanggal_sewa' => $request->tanggal_sewa,
            'tanggal_kembali' => $request->tanggal_kembali,
            'total_harga' => $totalHarga,
            'status_transaksi' => 'proses'
        ]);

        // 5. Ubah status mobil menjadi 'disewa' agar tidak bisa dipilih orang lain
        $mobil->update(['status' => 'disewa']);

        return redirect()->route('transaksi.index')->with('success', 'Transaksi rental berhasil dibuat!');
    }


    public function storeFromPublic(Request $request, $mobil_id)
    {
        try {
            // Dekripsi ID mobil
            $realId = \Crypt::decryptString($mobil_id);
            $mobil = Mobil::findOrFail($realId);

            // Validasi input
            $request->validate([
                'nama' => 'required|string|max:255',
                'no_hp' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'tgl_mulai' => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            ]);

            // Hitung durasi
            $tglMulai = Carbon::parse($request->tgl_mulai);
            $tglSelesai = Carbon::parse($request->tgl_selesai);
            $durasi = $tglMulai->diffInDays($tglSelesai) + 1; // +1 agar inclusive
            
            // Hitung total biaya
            $totalBiaya = $durasi * $mobil->harga_per_hari;

            // ✅ SIMPAN KE DATABASE TERLEBIH DAHULU
            $transaksi = Transaksi::create([
                'mobil_id' => $realId,
                'nama_peminjam' => $request->nama,
                'tanggal_sewa' => $request->tgl_mulai,
                'tanggal_kembali' => $request->tgl_selesai,
                'total_harga' => $totalBiaya,
                'status_transaksi' => 'proses'
            ]);

            // Update status mobil menjadi disewa
            $mobil->update(['status' => 'disewa']);

            // ✅ REDIRECT KE SUCCESS PAGE
            return redirect()->route('user.armada')
                ->with('success', 'Pesanan Anda berhasil dikirim! Admin akan menghubungi Anda di ' . $request->no_hp);

        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            abort(404);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function show(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update(['status_transaksi' => 'selesai']);

        // Ubah kembali status mobil menjadi 'tersedia'
        $transaksi->mobil->update(['status' => 'tersedia']);

        return redirect()->route('transaksi.index')->with('success', 'Mobil telah dikembalikan, transaksi selesai!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
