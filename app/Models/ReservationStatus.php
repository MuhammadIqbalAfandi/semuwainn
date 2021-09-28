<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_status_name',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
