<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'fullName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
        ]);

        $data = User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($data) {
            return response()->json([
                'status' => "ok",
                'message' => "Successfuly registered",
            ], 200);
        }

        return response()->json([
            'status' => "false",
            'message' => "Didn't registered",
        ], 500);
    }
}
