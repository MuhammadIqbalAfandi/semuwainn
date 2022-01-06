<?php

namespace App\Http\Requests\RoomType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomTypeRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:room_types,name,' . $this->id,
            'number_of_guest' => 'required|numeric',
            'facilities' => 'required',
            'prices.*' => 'required|numeric',
            'descriptions.*' => 'required|string|max:100',
        ];
    }
}
