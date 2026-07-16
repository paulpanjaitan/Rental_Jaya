<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mobil;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function ownerDashboard()
    {
        // 1. Hitung total armada mobil
        $totalMobil = Mobil::count();

        // 2. Ambil semua data riwayat transaksi (Eager loading relasi 'mobil')
        $transaksis = Transaksi::with('mobil')->orderBy('created_at', 'desc')->get();

        // 3. SESUAI DATABASE: Hitung total pemasukan berdasarkan kolom 'total_harga'
        $totalPemasukan = Transaksi::sum('total_harga'); 

        return view('owner.dashboard', compact('totalMobil', 'transaksis', 'totalPemasukan'));
    }
}