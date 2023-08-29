<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'category_name' => 'required|max:255',
            'category_slug' => 'required|unique:categories,category_slug|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'category_name.required' => 'The category name is required.',
            'category_name.max' => 'The category name must not exceed 255 characters.',
            'category_slug.required' => 'The category slug is required.',
            'category_slug.unique' => 'The category slug is already taken.',
            'category_slug.max' => 'The category slug must not exceed 255 characters.',
        ];
    }
}
