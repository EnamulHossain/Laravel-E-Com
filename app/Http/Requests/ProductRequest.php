<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required|string',
            'code' => 'required|string',
            'category_id' => 'required|numeric',
            'subcategory_id' => 'required|numeric',
            'childcategory_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'tags' => 'nullable|string',
            'purchase_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'discount_price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'stock' => 'nullable|numeric',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'The :attribute field is required.',
            'numeric' => 'The :attribute field must be a number.',
            'string' => 'The :attribute field must be a string.',
            'boolean' => 'The :attribute field must be a boolean.',
        ];
    }
}
