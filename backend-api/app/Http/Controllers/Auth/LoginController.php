<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $loginUser = User::where('email', $request->email)->where('password', $request->password)->first();
        if ($loginUser && $loginUser->email == $request->email && $loginUser->password == $request->password) {
            $user = Auth::loginUsingId($loginUser->id);
            $success['token'] = 'Bearer ' . $user->createToken('Login')->accessToken;
            return response()->json([
                'message' => 'Logged in successfully redirecting...',
                'token' => $success,
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'errors' => [
                'email'=>['Email and password not matched'],
            ],
        ], 422);
    }

    public function logout(Request $request)
    {
        if (Auth::check()) {
            Auth::user()->authUserToken()->delete();
            return response()->json([
                'message' => 'success logout'
            ], 200);
        }
        return response()->json([
            'error' => 'Unouthorized'
        ], 401);
    }
}
