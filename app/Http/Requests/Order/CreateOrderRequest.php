<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'shipping_address' => ['required', 'string', 'min:50'],
            'payment_method' => ['required', 'string', 'min:1'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.variant_id' => ['required', 'exists:variants,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1']
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_address.required' => 'Shipping address is required.',
            'shipping_address.string'   => 'Shipping address must be a valid string.',
            'shipping_address.min'      => 'Shipping address must be at least 50 characters long.',

            'payment_method.required'   => 'Payment method is required.',
            'payment_method.string'     => 'Payment method must be a valid string.',
            'payment_method.min'        => 'Payment method cannot be empty.',

            'items.required'            => 'Order items are required.',
            'items.array'               => 'Order items must be an array.',
            'items.min'                 => 'At least one item must be included in the order.',

            'items.*.variant_id.required' => 'Variant ID is required for each item.',
            'items.*.variant_id.exists'   => 'The selected variant does not exist.',

            'items.*.quantity.required' => 'Quantity is required for each item.',
            'items.*.quantity.integer'  => 'Quantity must be an integer.',
            'items.*.quantity.min'      => 'Quantity must be at least 1.',
        ];
    }
}
