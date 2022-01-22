<?php

namespace App\Models;

use App\Models\Guest;
use App\Models\ReservationStatus;
use App\Models\RestaurantOrder;
use App\Models\Room;
use App\Models\RoomOrder;
use App\Models\ServiceOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_number',
        'checkin',
        'checkout',
        'discount',
        'user_id',
        'guest_id',
        'reservation_status_id',
    ];

    public function getReservationTimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getCheckInAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getCheckOutAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function reservationStatus()
    {
        return $this->belongsTo(ReservationStatus::class);
    }

    public function roomOrders()
    {
        return $this->hasMany(RoomOrder::class);
    }

    public function serviceOrders()
    {
        return $this->hasMany(ServiceOrder::class);
    }

    public function restaurantOrders()
    {
        return $this->hasMany(RestaurantOrder::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, RoomOrder::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class)->latest();
    }
}
