<?php

namespace App\Http\Requests\Gift;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => 'nullable',
            'name' => 'required|unique:gifts,name',
            'price' => 'required|numeric',
            'image' => 'required',
            'is_popular' => 'nullable|boolean'
        ];
    }

    public function attributes(): array
    {
        return [
            'category' => 'Category',
            'name' => 'Name',
            'price' => 'Price',
            'image' => 'Image',
            'is_popular' => 'Is Popular'
        ];
    }
}
