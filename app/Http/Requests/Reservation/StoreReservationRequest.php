<?php

namespace App\Http\Requests\Reservation;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
        $today = Carbon::now()->format('d/m/Y');
        return [
            'guest_id' => 'required|numeric',
            'adult' => 'required|numeric|min:0|max:4',
            'children' => 'required|numeric|min:0|max:4',
            'checkin' => 'required|date_format:d/m/Y|after_or_equal:' . $today,
            'checkout' => 'required|date_format:d/m/Y|after:checkin',
        ];
    }
}
