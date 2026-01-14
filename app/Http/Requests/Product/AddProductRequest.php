<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:5', 'max:255'],
            'description' => ['required', 'string', 'min:50', 'max:1000'],
            'category_id' => ['required', 'exists:categories,id'],

            'variants.*.size' => ['required', 'string', 'min:1'],
            'variants.*.stock' => ['required', 'numeric', 'min:10'],
            'variants.*.price' => ['required', 'numeric', 'min:5'],
            'variants.*.weight' => ['required', 'numeric', 'min:1000'],

            'product_attributes.*.name' => ['required', 'string', 'min:1'],
            'product_attributes.*.value' => ['required', 'string', 'min:1'],
        ];
    }
}
