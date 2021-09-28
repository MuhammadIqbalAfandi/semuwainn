<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RoomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrival_date',
        'departure_date',
        'user_id',
        'room_id',
        'price',
        'discount',
        'room_order_status_id'
    ];

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

    /**
     * Get date indonesia format
     *
     * @param date $value
     * @return date
     */
    public function getOrderTimeAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Get date indonesia format
     *
     * @param date $value
     * @return date
     */
    public function getArrivalDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Set date indonesia format
     *
     * @param  string  $value
     * @return void
     */
    public function setArrivalDateAttribute($value)
    {
        $this->attributes['arrival_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    /**
     * Get date indonesia format
     *
     * @param date $value
     * @return date
     */
    public function getDepartureDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Set date indonesia format
     *
     * @param  string  $value
     * @return void
     */
    public function setDepartureDateAttribute($value)
    {
        $this->attributes['departure_date'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }
}
