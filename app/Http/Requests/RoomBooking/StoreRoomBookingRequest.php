<?php

namespace App\Http\Requests\RoomBooking;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nik' => 'required|digits:16',
            'name' => 'required|string|max:50',
            'phone' => 'required|min:12',
            'email' => 'email:dns|nullable',
            'checkIn' => 'required|date',
            'checkOut' => 'required|date',
        ];
    }
}
