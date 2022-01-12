<?php

namespace App\Models;

use App\Models\RoomFacility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function roomFacilities()
    {
        return $this->hasMany(RoomFacility::class);
    }
}
