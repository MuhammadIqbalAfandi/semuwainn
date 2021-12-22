<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberOfGuest extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest',
    ];
}
