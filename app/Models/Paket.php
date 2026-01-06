<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kode',
        'harga',
        'satuan',
        'jenis_layanan',
        'estimasi_hari',
        'is_express',
        'keterangan',
    ];

    protected $casts = [
        'is_express' => 'boolean',
        'harga' => 'integer',
        'estimasi_hari' => 'integer',
    ];
}
