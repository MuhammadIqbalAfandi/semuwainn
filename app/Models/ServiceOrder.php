<?php

namespace App\Models;

use App\Models\Reservation;
use App\Models\Service;
use App\Traits\HelperTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class ServiceOrder extends Model
{
    use HasFactory, HelperTrait;

    protected $fillable = [
        'price',
        'quantity',
        'reservation_id',
        'service_id',
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

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
