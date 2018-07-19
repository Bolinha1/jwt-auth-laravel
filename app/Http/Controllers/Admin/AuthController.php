<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ], 200);
    }
    public function logado()
    {
        return response()->json(['user' => auth()->guard('api')->user()], 200);
    }
}
