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

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.string' => 'Product name must be a string.',
            'name.min' => 'Product name must be at least :min characters.',
            'name.max' => 'Product name may not be greater than :max characters.',

            'description.required' => 'Product description is required.',
            'description.string' => 'Product description must be a string.',
            'description.min' => 'Product description must be at least :min characters.',
            'description.max' => 'Product description may not be greater than :max characters.',

            'category_id.required' => 'Product category is required.',
            'category_id.exists' => 'The selected product category is invalid.',

            'variants.required' => 'Product variants are required.',
            'variants.array' => 'Product variants must be an array.',

            'variants.*.size.required' => 'Variant size is required.',
            'variants.*.size.string' => 'Variant size must be a string.',
            'variants.*.size.min' => 'Variant size must be at least :min characters.',

            'variants.*.stock.required' => 'Variant stock is required.',
            'variants.*.stock.numeric' => 'Variant stock must be a number.',
            'variants.*.stock.min' => 'Variant stock must be at least :min.',

            'variants.*.price.required' => 'Variant price is required.',
            'variants.*.price.numeric' => 'Variant price must be a number.',
            'variants.*.price.min' => 'Variant price must be at least :min.',

            'variants.*.weight.required' => 'Variant weight is required.',
            'variants.*.weight.numeric' => 'Variant weight must be a number.',
            'variants.*.weight.min' => 'Variant weight must be at least :min grams.',

            'product_attributes.required' => 'Product attributes are required.',
            'product_attributes.array' => 'Product attributes must be an array.',

            'product_attributes.*.name.required' => 'Attribute name is required.',
            'product_attributes.*.name.string' => 'Attribute name must be a string.',
            'product_attributes.*.name.min' => 'Attribute name must be at least :min characters.',

            'product_attributes.*.value.required' => 'Attribute value is required.',
            'product_attributes.*.value.string' => 'Attribute value must be a string.',
            'product_attributes.*.value.min' => 'Attribute value must be at least :min characters.',
        ];
    }
}
