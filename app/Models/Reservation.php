<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\ReservationStatus;
use App\Models\Room;
use App\Models\RoomPrice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_id',
        'reservation_status_id',
        'reservation_number',
        'adult',
        'children',
    ];

    /**
     * Get date indonesia format
     *
     * @param date $value
     * @return date
     */
    public function getReservedDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function roomPrice()
    {
        return $this->belongsTo(RoomPrice::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function roomOrders()
    {
        return $this->hasMany(RoomOrder::class);
    }
}
