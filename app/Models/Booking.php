<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'item_id',
        'booking_code',
        'snap_token',
        'date',
        'duration',
        'total',
        'dp',
        'fine',
        'delay',
        'status',
    ];

    // Relasi ke User (satu booking dimiliki satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Item (satu booking untuk satu item)
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
