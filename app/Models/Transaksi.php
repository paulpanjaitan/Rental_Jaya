<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['mobil_id', 'nama_peminjam', 'tanggal_sewa', 'tanggal_kembali', 'total_harga', 'status_transaksi'];

    // Relasi: Transaksi ini milik sebuah Mobil
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
