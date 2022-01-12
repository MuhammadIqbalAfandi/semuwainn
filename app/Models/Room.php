<?php

namespace App\Models;

use App\Models\RoomOrder;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_number',
        'room_type_id',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function roomOrders()
    {
        return $this->hasMany(RoomOrder::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
