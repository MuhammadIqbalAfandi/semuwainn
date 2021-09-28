<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'user_id',
        'reservation_id',
        'service_id',
    ];
}
