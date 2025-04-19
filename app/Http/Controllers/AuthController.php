<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends ApiController
{   
    public function register(RegisterRequest $request) {
            
        User::create($request->userData());
        return $this->ok([], 'User registered successfully');

        // User::create([
        //     'name' => $validated['name'],
        //     'username' => $validated['username'],
        //     'email' => $validated['email'],
        //     'password' => bcrypt($validated['password']),
        // ]);        
        //return $this->ok([], 'User registered successfully');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->userData();
        
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth('api')->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
