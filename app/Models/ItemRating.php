<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRating extends Model
{
    use HasFactory;

    protected $table = 'item_ratings';

    protected $fillable = [
        'user_id',
        'item_id',
        'rating',
        'review',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Item
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
