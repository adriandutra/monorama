<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $request)
    {   

        $user = $this->userRepository->create([
            "username"  => $request->username,
            "password"  => Hash::make($request->password),
            "is_active" => $request->is_active,
            "role" => $request->role
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token
        ], 201);
    }

    public function login(LoginRequest $request) 
    {
        $credentials = $request->only('username', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials))
            {
                $result = [
                    "meta" => array("success" => false, 
                                    "errors" => [ "Password incorrect for ". $request->username])
                ];

                return response()->json($result, 400);
            }
        } catch(JWTException $e) {
            return response()->json([
                'error' => 'not create token'
            ], 500);
        }

        $this->userRepository->updateLastLogin($request->username);

        $result = [
            "meta" => array("success" => true, "errors" => []),
            "data" => array("token" => $token, "minutes_to_expire" => 1440)
        ];

        return response()->json($result);
    }
}
