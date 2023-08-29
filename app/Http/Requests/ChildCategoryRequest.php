<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChildCategoryRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'child_category_name' => 'required|string|max:255',
            'child_category_slug' => 'required|string|max:255|unique:child_categories,child_category_slug',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Please select a category.',
            'category_id.exists' => 'The selected category does not exist.',
            'subcategory_id.required' => 'Please select a subcategory.',
            'subcategory_id.exists' => 'The selected subcategory does not exist.',
            'child_category_name.required' => 'The child category name is required.',
            'child_category_name.string' => 'The child category name must be a string.',
            'child_category_name.max' => 'The child category name must not exceed 255 characters.',
            'child_category_slug.required' => 'The child category slug is required.',
            'child_category_slug.string' => 'The child category slug must be a string.',
            'child_category_slug.max' => 'The child category slug must not exceed 255 characters.',
            'child_category_slug.unique' => 'The child category slug is already taken.',
        ];
    }
}
