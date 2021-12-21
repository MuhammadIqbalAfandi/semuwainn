<?php

namespace App\Http\Requests\Guest;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGuestRequest extends FormRequest
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
            'nik' => 'required|digits:16|unique:guests,nik,' . $this->id,
            'name' => 'required|string',
            'phone' => 'required|digits:12|unique:guests,phone,' . $this->id,
            'email' => 'email|nullable|unique:guests,email,' . $this->id,
        ];
    }
}
