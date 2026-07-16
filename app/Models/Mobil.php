<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $fillable = ['merek', 'model', 'nopol', 'harga_per_hari', 'status', 'gambar'];
    //                                                                                   ↑ TAMBAHKAN INI!
}