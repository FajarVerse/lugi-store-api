<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function store(ChangePasswordRequest $request)
    {
        $request->user()->update([
            'password' => Hash::make($request->password)
        ]);

        return response()->json([
            'message' => 'Password changed successfully'
        ], 200);
    }
}
