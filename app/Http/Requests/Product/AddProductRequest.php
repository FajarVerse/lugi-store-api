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
            'name.required' => 'Nama produk wajib diisi.',
            'name.string' => 'Nama produk harus berupa teks.',
            'name.min' => 'Nama produk minimal :min karakter.',
            'name.max' => 'Nama produk maksimal :max karakter.',

            'description.required' => 'Deskripsi produk wajib diisi.',
            'description.string' => 'Deskripsi produk harus berupa teks.',
            'description.min' => 'Deskripsi produk minimal :min karakter.',
            'description.max' => 'Deskripsi produk maksimal :max karakter.',

            'category_id.required' => 'Kategori produk wajib dipilih.',
            'category_id.exists' => 'Kategori yang dipilih tidak valid.',

            'variants.required' => 'Variant produk wajib diisi.',
            'variants.array' => 'Format variant tidak valid.',

            'variants.*.size.required' => 'Ukuran variant wajib diisi.',
            'variants.*.size.string' => 'Ukuran variant harus berupa teks.',
            'variants.*.size.min' => 'Ukuran variant minimal :min karakter.',

            'variants.*.stock.required' => 'Stok variant wajib diisi.',
            'variants.*.stock.numeric' => 'Stok variant harus berupa angka.',
            'variants.*.stock.min' => 'Stok variant minimal :min.',

            'variants.*.price.required' => 'Harga variant wajib diisi.',
            'variants.*.price.numeric' => 'Harga variant harus berupa angka.',
            'variants.*.price.min' => 'Harga variant minimal :min.',

            'variants.*.weight.required' => 'Berat variant wajib diisi.',
            'variants.*.weight.numeric' => 'Berat variant harus berupa angka.',
            'variants.*.weight.min' => 'Berat variant minimal :min gram.',

            'product_attributes.required' => 'Atribut produk wajib diisi.',
            'product_attributes.array' => 'Format atribut produk tidak valid.',

            'product_attributes.*.name.required' => 'Nama atribut produk wajib diisi.',
            'product_attributes.*.name.string' => 'Nama atribut produk harus berupa teks.',
            'product_attributes.*.name.min' => 'Nama atribut produk minimal :min karakter.',

            'product_attributes.*.value.required' => 'Nilai atribut produk wajib diisi.',
            'product_attributes.*.value.string' => 'Nilai atribut produk harus berupa teks.',
            'product_attributes.*.value.min' => 'Nilai atribut produk minimal :min karakter.',
        ];
    }
}
