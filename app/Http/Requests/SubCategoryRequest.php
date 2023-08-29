<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            'subcategory_name' => 'required|string|max:255',
            'subcategory_slug' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'subcategory_name.required' => 'The subcategory name is required.',
            'subcategory_name.string' => 'The subcategory name must be a string.',
            'subcategory_name.max' => 'The subcategory name must not exceed 255 characters.',
            'subcategory_slug.required' => 'The subcategory slug is required.',
            'subcategory_slug.string' => 'The subcategory slug must be a string.',
            'subcategory_slug.max' => 'The subcategory slug must not exceed 255 characters.',
        ];
    }
}
