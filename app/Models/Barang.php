<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'stok', 'harga', 'pemasok_id'];

    // Relasi ke transaksi
    public function transaksis()
    {
        return $this->hasMany(\App\Models\Transaksi::class, 'barang_id');
    }

    // Relasi ke pemasok
    public function pemasok()
    {
        return $this->belongsTo(\App\Models\Pemasok::class, 'pemasok_id');
    }
}
