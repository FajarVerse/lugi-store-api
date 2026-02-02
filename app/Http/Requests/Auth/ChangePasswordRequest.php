<?php

namespace App\Http\Requests\Auth;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()]
        ];
    }


    public function messages(): array
    {
        return [
            // current password
            'old_password.required' => 'Old password must be filled in',
            'old_password.current_password' => 'The old password is incorrect',

            'password.required' => 'Password is required',
            'password.confirmed' => 'Password confirmation is incorrect',
            'password.min' => 'Password must be at least 8 characters',
            'password.mixedCase' => 'Password must contain both upper and lower case letters',
            'password.numbers' => 'Password must contain numbers',
            'password.symbols' => 'Password must contain symbols',
        ];
    }
}
