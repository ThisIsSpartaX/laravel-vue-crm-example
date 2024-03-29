<?php

namespace App\Http\Requests\Api\Department;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * @throws
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:1|max:255',
            'description' => 'required|string|max:500',
            'logo' => 'required|string|max:255',
            'users' => 'nullable|sometimes|array',
            'users.*.id' => 'required_with:users|integer',
            'users.*.name' => 'required_with:users|string|max:255',
        ];
    }
}