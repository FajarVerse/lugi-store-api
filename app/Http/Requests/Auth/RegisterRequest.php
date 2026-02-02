<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'username' => ['required', 'string', 'min:3', 'max:255'],
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
            'name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[A-Za-z\s]+$/'],
            'email' => ['required', 'string', 'email', 'min:7', 'max:255', 'unique:users,email'],
        ];
    }

    public function messages(): array
    {
        return [
            'username.required' => 'Username is required.',
            'username.min' => 'Username must be at least :min characters.',
            'username.max' => 'Username may not be greater than :max characters.',

            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least :min characters.',
            'password.mixedCase' => 'Password must contain both uppercase and lowercase letters.',
            'password.numbers' => 'Password must contain at least one number.',
            'password.symbols' => 'Password must contain at least one symbol.',

            'name.required' => 'Name is required.',
            'name.min' => 'Name must be at least :min characters.',
            'name.max' => 'Name may not be greater than :max characters.',
            'name.regex' => 'Name may only contain letters and spaces.',

            'email.required' => 'Email address is required.',
            'email.email' => 'The email address format is invalid.',
            'email.min' => 'Email address must be at least :min characters.',
            'email.max' => 'Email address may not be greater than :max characters.',
            'email.unique' => 'The email address has already been taken.',
        ];
    }
}
