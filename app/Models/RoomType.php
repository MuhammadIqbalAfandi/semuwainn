<?php

namespace App\Models;

use App\Models\RoomPrice;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number_of_guest_id',
    ];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }

    public function numberOfGuest()
    {
        return $this->belongsTo(NumberOfGuest::class);
    }
}
