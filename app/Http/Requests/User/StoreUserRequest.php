<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'phone' => 'required|string|digits:12|unique:users,phone',
            'address' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|numeric'
        ];
    }
}
