<?php

namespace App\Http\Requests\Thumbnail;

use Illuminate\Foundation\Http\FormRequest;

class ProcessThumbnailRequest extends FormRequest
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
            'thumbnails.*' => 'image|mimes:png,jpg,webp|max:1024',
        ];
    }
}
