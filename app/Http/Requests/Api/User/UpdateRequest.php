<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
        $rules = [
            'name' => 'required|string|min:1|max:255',
            'email' => 'required|email|unique:users,email,' . $this->route('id'),
            'password' => 'nullable|min:6|max:20|confirmed',
            'password_confirmation' => 'required_with:password|same:password',
        ];

        //Set current user password required
        if (Auth::user()->id == $this->id) {
            $rules['current_password'] = 'required_with:password';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'password.required' => 'New password is required',
            'current_password.required' => 'Current password is required',
        ];
    }
}