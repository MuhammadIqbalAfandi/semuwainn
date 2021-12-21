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
    ];

    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }

    public function roomPrices()
    {
        return $this->hasMany(RoomPrice::class);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
