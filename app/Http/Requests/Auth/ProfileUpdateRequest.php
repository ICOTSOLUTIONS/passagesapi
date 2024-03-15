<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => "required",
            'email' => "required|email|unique:users,email," . auth()->user()->id,
            'image' => "nullable|image|mimes:png,jpg,jpeg",
            'phone' => "nullable",
            'gender' => "nullable",
            'dob' => "nullable",
            'is_privacy_policy' => "nullable"
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => "Full name",
            'email' => "Email",
            'image' => "Image",
            'phone' => "Phone",
            'gender' => "Gender",
            'dob' => "Date of Birth",
        ];
    }
}
