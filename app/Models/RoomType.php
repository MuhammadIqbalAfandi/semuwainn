<?php

namespace App\Models;

use App\Models\Room;
use App\Models\RoomFacility;
use App\Models\RoomOrder;
use App\Models\RoomPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $with = [
        'roomOrders',
        'rooms',
    ];

    protected $fillable = [
        'name',
        'number_of_guest',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomOrders()
    {
        return $this->hasManyThrough(RoomOrder::class, Room::class);
    }

    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }

    public function scopeFilter($query)
    {
        $roomId = $query->get()->transform(fn($roomType) => [
            $roomType->roomOrders->pluck('room_id'),
        ])->flatten();
        $roomTypeId = $query->get()->transform(fn($roomType) => [
            $roomType->rooms->whereNotIn('id', $roomId)->pluck('room_type_id'),
        ])->flatten();
        $query->whereIn('id', $roomTypeId);
    }
}
