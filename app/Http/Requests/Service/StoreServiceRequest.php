<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'name' => 'required|string|max:50|unique:services,name',
            'price' => 'required|numeric',
            'service_unit_id' => 'required',
        ];
    }
}
