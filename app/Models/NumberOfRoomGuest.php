<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberOfRoomGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_type_id',
        'number_of_guest_id',
    ];
}