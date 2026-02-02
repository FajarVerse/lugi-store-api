<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['sometimes', 'string', 'min:5', 'max:255'],
            'description' => ['sometimes', 'string', 'min:50', 'max:1000'],
            'category_id' => ['sometimes', 'exists:categories,id'],

            'variants' => ['sometimes', 'array', 'min:1'],
            'variants.*.id' => ['sometimes', 'exists:variants,id'],
            'variants.*.size' => ['sometimes', 'string', 'min:1'],
            'variants.*.stock' => ['sometimes', 'integer', 'min:10'],
            'variants.*.price' => ['sometimes', 'integer', 'min:5'],
            'variants.*.weight' => ['sometimes', 'integer', 'min:1000'],

            'product_attributes' => ['sometimes', 'array'],
            'product_attributes.*.id' => ['sometimes', 'exists:attributes,id'],
            'product_attributes.*.name' => ['sometimes', 'string', 'min:1'],
            'product_attributes.*.value' => ['sometimes', 'string', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'Product name must be a string.',
            'name.min' => 'Product name must be at least :min characters.',
            'name.max' => 'Product name may not be greater than :max characters.',

            'description.string' => 'Product description must be a string.',
            'description.min' => 'Product description must be at least :min characters.',
            'description.max' => 'Product description may not be greater than :max characters.',

            'category_id.exists' => 'The selected category is invalid.',

            'variants.array' => 'Variants must be an array.',
            'variants.min' => 'There must be at least :min variant.',

            'variants.*.id.exists' => 'The selected variant is invalid.',

            'variants.*.size.string' => 'Variant size must be a string.',
            'variants.*.size.min' => 'Variant size must be at least :min characters.',

            'variants.*.stock.integer' => 'Variant stock must be an integer.',
            'variants.*.stock.min' => 'Variant stock must be at least :min.',

            'variants.*.price.integer' => 'Variant price must be an integer.',
            'variants.*.price.min' => 'Variant price must be at least :min.',

            'variants.*.weight.integer' => 'Variant weight must be an integer.',
            'variants.*.weight.min' => 'Variant weight must be at least :min grams.',

            'product_attributes.array' => 'Product attributes must be an array.',

            'product_attributes.*.id.exists' => 'The selected product attribute is invalid.',

            'product_attributes.*.name.string' => 'Attribute name must be a string.',
            'product_attributes.*.name.min' => 'Attribute name must be at least :min characters.',

            'product_attributes.*.value.string' => 'Attribute value must be a string.',
            'product_attributes.*.value.min' => 'Attribute value must be at least :min characters.',
        ];
    }
}
