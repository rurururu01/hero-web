<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Makanan extends Model
{
    protected $table = 'makanan';
    
    protected $fillable = [
        'nama_barang',
        'jenis_barang',
        'stok',
        'tanggal_kadaluarsa',
        'harga_beli',
        'harga_jual'
    ];

    protected $casts = [
        'tanggal_kadaluarsa' => 'date',
        'harga_beli' => 'decimal:2',
        'harga_jual' => 'decimal:2'
    ];
}
