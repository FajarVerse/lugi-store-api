<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|string|min:3|max:255',
                'password' => ['required', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
                'name' => 'required|string|min:3|max:255|regex:/^[A-Za-z\s]+$/',
                'email' => 'required|string|lowercase|email|min:7|max:255|unique:' . User::class,
                'phone' => 'required|string|regex:/^[0-9]{11,15}$/'
            ],
            [
                // Username
                'username.required' => 'Username wajib diisi.',
                'username.min' => 'Username minimal 3 karakter.',
                'username.max' => 'Username maksimal 255 karakter.',

                // Password
                'password.required' => 'Password wajib diisi.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password.min' => 'Password minimal 8 karakter.',
                'password.mixedCase' => 'Password harus mengandung huruf besar dan kecil.',
                'password.numbers' => 'Password harus mengandung angka.',
                'password.symbols' => 'Password harus mengandung simbol.',

                // Name
                'name.required' => 'Nama wajib diisi.',
                'name.min' => 'Nama minimal 3 karakter.',
                'name.max' => 'Nama maksimal 255 karakter.',
                'name.regex' => 'Nama hanya boleh berisi huruf dan spasi.',

                // Email
                'email.required' => 'Email wajib diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.min' => 'Email minimal 7 karakter.',
                'email.max' => 'Email maksimal 255 karakter.',
                'email.unique' => 'Email sudah terdaftar.',

                // Phone
                'phone.required' => 'Nomor telepon wajib diisi.',
                'phone.regex' => 'Nomor telepon harus berupa angka dan terdiri dari 11–15 digit.'
            ]
        );

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone
        ]);

        event(new Registered($user));

        return response()->json([
            'message' => 'Registrasi Berhasil',
            'data' => [
                'id' => $user->id,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone
            ]
        ], 201);
    }
}
