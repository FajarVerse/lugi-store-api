<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class AddCategoryRequest extends FormRequest
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
            'categories' => ['required', 'array', 'min:1'],
            'categories.*.name' => ['required', 'string', 'min:3', 'max:50', 'regex:/^[A-Za-z ]+(-[A-Za-z ]+)*$/']
        ];
    }

    public function messages(): array
    {
        return [
            'categories.required' => 'Categories field is required.',
            'categories.array' => 'Categories must be an array.',
            'categories.min' => 'At least :min category is required.',

            'categories.*.name.required' => 'Category name is required.',
            'categories.*.name.string' => 'Category name must be a string.',
            'categories.*.name.min' => 'Category name must be at least :min characters.',
            'categories.*.name.max' => 'Category name may not be greater than :max characters.',
            'categories.*.name.regex' => 'Category name may only contain letters, spaces, and hyphens.',
        ];
    }
}
