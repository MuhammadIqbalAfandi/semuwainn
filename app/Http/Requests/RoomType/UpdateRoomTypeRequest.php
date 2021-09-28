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
            'room_type_name' => 'required|string|max:50|unique:room_types,room_type_name,' . $this->id,
            'facilities' => 'required',
            'prices.*' => 'required|numeric',
            'descriptions.*' => 'required|string|max:100',
        ];
    }
}
