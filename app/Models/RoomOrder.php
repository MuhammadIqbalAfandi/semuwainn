<?php

namespace App\Models;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'user_id',
        'room_id',
        'reservation_id',
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
    public function getCheckinAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Set date indonesia format
     *
     * @param  string  $value
     * @return void
     */
    public function setCheckinAttribute($value)
    {
        $this->attributes['Checkin'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }

    /**
     * Get date indonesia format
     *
     * @param date $value
     * @return date
     */
    public function getCheckoutAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    /**
     * Set date indonesia format
     *
     * @param  string  $value
     * @return void
     */
    public function setCheckoutAttribute($value)
    {
        $this->attributes['checkout'] = Carbon::createFromFormat('d/m/Y', $value)->toDateString();
    }
}
