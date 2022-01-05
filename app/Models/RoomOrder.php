<?php

namespace App\Models;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class RoomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'guest_count',
        'quantity',
        'reservation_id',
        'room_id',
    ];

    public function getOrderTimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getCheckinAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setCheckinAttribute($value)
    {
        $this->attributes['Checkin'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function getCheckoutAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setCheckoutAttribute($value)
    {
        $this->attributes['checkout'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
