<?php

namespace App\Http\Requests\Api\Upload;

use Illuminate\Foundation\Http\FormRequest;

class UploadImageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image',
        ];
    }
}