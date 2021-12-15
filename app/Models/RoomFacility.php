<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_id',
        'room_type_id',
    ];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function roomType()
    {
        return $this->belongsTo(RoomType::class);
    }
}
