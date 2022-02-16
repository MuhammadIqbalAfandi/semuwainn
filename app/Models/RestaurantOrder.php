<?php

namespace App\Models;

use App\Models\Reservation;
use App\Models\Restaurant;
use App\Traits\RestaurantOrderTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RestaurantOrder extends Model
{
    use HasFactory, RestaurantOrderTrait;

    protected $fillable = [
        'price',
        'quantity',
        'reservation_id',
        'restaurant_id',
    ];

    public function getPriceAttribute($value)
    {
        return self::setRupiahFormat($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getOrderTimeAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('l d/m/Y H:i:s');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function totalPrice()
    {
        return self::setRupiahFormat($this->getRawOriginal('price') * $this->quantity);
    }
}
