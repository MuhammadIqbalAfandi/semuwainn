<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type_id',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }

    public function roomOrder()
    {
        return $this->hasMany(RoomOrder::class);
    }
}
