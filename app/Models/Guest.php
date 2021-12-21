<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'nik',
        'name',
        'phone',
        'email',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
