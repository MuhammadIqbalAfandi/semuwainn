<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomThumbnail extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'thumbnail_id',
    ];
}
