<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'user_id',
        'kode',
        'nama',
        'kategori',
        'jumlah',
        'satuan',
        'harga',
        'supplier',
        'tanggal',
        'foto',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pesanans()
    {
        return $this->belongsToMany(Pesanan::class, 'barang_pesanan')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}