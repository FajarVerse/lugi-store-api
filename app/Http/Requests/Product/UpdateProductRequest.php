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

    public function messages(): array
    {
        return [
            'name.string' => 'Nama produk harus berupa teks.',
            'name.min' => 'Nama produk minimal :min karakter.',
            'name.max' => 'Nama produk maksimal :max karakter.',
            'description.string' => 'Deskripsi produk harus berupa teks.',
            'description.min' => 'Deskripsi produk minimal :min karakter.',
            'description.max' => 'Deskripsi produk maksimal :max karakter.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'variants.array' => 'Format variants harus berupa array.',
            'variants.min' => 'Minimal harus ada :min variant.',
            'variants.*.id.exists' => 'Variant yang dipilih tidak valid.',
            'variants.*.size.string' => 'Ukuran variant harus berupa teks.',
            'variants.*.size.min' => 'Ukuran variant minimal :min karakter.',
            'variants.*.stock.integer' => 'Stok variant harus berupa angka bulat.',
            'variants.*.stock.min' => 'Stok variant minimal :min.',
            'variants.*.price.integer' => 'Harga variant harus berupa angka bulat.',
            'variants.*.price.min' => 'Harga variant minimal :min.',
            'variants.*.weight.integer' => 'Berat variant harus berupa angka bulat.',
            'variants.*.weight.min' => 'Berat variant minimal :min gram.',

            'attributes.array' => 'Format atribut harus berupa array.',
            'attributes.*.id.exists' => 'Atribut yang dipilih tidak valid.',
            'attributes.*.name.string' => 'Nama atribut harus berupa teks.',
            'attributes.*.name.min' => 'Nama atribut minimal :min karakter.',
            'attributes.*.value.string' => 'Nilai atribut harus berupa teks.',
            'attributes.*.value.min' => 'Nilai atribut minimal :min karakter.',
        ];
    }
}
