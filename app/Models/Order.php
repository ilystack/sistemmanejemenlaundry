<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paket_id',
        'tipe_paket',
        'jumlah',
        'pickup',
        'metode_pembayaran',
        'customer_latitude',
        'customer_longitude',
        'jarak_km',
        'ongkir',
        'total_harga',
        'antrian',
        'status',
        'payment_status',
        'payment_token',
        'payment_token_expires_at',
        'qr_code_path',
    ];

    protected $casts = [
        'ongkir' => 'integer',
        'total_harga' => 'integer',
        'antrian' => 'integer',
        'jarak_km' => 'decimal:2',
        'customer_latitude' => 'decimal:7',
        'customer_longitude' => 'decimal:7',
        'payment_token_expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paket()
    {
        return $this->belongsTo(Paket::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function testimonial()
    {
        return $this->hasOne(Testimonial::class);
    }
}
