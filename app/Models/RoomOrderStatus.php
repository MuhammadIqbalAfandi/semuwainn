<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_order_status_name',
    ];
}
