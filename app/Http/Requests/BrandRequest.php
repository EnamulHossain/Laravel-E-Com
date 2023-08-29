<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
    public function rules()
    {
        return [
            'brand_name' => 'required|string|max:255',
            'brand_slug' => 'required|string|max:255|unique:brands,brand_slug',
        ];
    }

    public function messages()
    {
        return [
            'brand_name.required' => 'The brand name is required.',
            'brand_name.string' => 'The brand name must be a string.',
            'brand_name.max' => 'The brand name must not exceed 255 characters.',
            'brand_slug.required' => 'The brand slug is required.',
            'brand_slug.string' => 'The brand slug must be a string.',
            'brand_slug.max' => 'The brand slug must not exceed 255 characters.',
            'brand_slug.unique' => 'The brand slug is already taken.',
            // Add more custom messages for other fields as needed
        ];
    }
}
