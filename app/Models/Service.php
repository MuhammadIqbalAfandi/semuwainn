<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'service_unit_id',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPriceAttribute($value)
    {
        return 'Rp. ' . number_format($value, '2', ',', '.');
    }

    public function serviceUnit()
    {
        return $this->belongsTo(ServiceUnit::class);
    }
}
