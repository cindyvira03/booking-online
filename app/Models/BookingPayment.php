<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'amount',
        'snap_token',
        'date',
    ];

    /**
     * Relasi ke Booking
     */
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
