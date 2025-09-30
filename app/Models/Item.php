<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    // Mass assignable fields
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'price',
        'description',
        'status',
    ];

    /**
     * Relasi ke Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
    public function images()
    {
        return $this->hasMany(ItemImage::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function itemRatings()
    {
        return $this->hasMany(ItemRating::class);
    }
}
