<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = [
        'nama_produk', 
        'kategori_produk',
        'harga_produk',
        'keterangan_produk',
        'status_produk'
    ];
}
