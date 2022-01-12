<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'reservation_id',
        'restaurant_id',
    ];

    public function getPriceAttribute($value)
    {
        return 'Rp. ' . number_format($value, '2', ',', '.');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
