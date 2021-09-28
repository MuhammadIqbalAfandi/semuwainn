<?php

namespace App\Models;

use App\Models\Reservation;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'description',
        'price',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
