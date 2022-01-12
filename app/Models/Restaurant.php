<?php

namespace App\Models;

use App\Models\RestaurantOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'unit',
        'price',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPriceAttribute($value)
    {
        return 'Rp. ' . number_format($value, '2', ',', '.');
    }

    public function restaurantOrder()
    {
        return $this->hasMany(RestaurantOrder::class);
    }
}
