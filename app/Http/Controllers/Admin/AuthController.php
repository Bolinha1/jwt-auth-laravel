<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    private $ttlSeconds = 60;

    public function login()
    {
        $credentials = request(['email', 'password']);

        //validate fields inputs

        if (! $token = auth()->guard('api')->claims(['role' => 'admin'])->setTTL($this->ttlSeconds)->attempt($credentials))
            return response()->json(['error' => 'Unauthorized'], 401);

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

    public function refreshToken()
    {
        $newToken = auth()->guard('api')->refresh(true, true);
        return response()->json([
            'access_token' => $newToken,
            'token_type' => 'bearer',
            'expires_in' => $this->ttlSeconds
        ], 200);
        return $this->respondWithToken();
    }

}
