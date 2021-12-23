<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type_id',
    ];

    public function roomOrder()
    {
        return $this->hasMany(RoomOrder::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
