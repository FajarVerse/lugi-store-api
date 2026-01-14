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

            'attributes' => ['sometimes', 'array'],
            'attributes.*.id' => ['sometimes', 'exists:attributes,id'],
            'attributes.*.name' => ['sometimes', 'string', 'min:1'],
            'attributes.*.value' => ['sometimes', 'string', 'min:1'],
        ];
    }
}
