<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\UserRepositoryInterface;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\LoginUserRequest;


class AuthController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
        $this->userRepository = $userRepository;
    }

    public function register(RegisterUserRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userRepository->create(array_merge(
            $request->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json([
            'message' => 'Agent successfully registered',
            'user' => $user
        ], 201);
    }

    public function login(LoginUserRequest $request): \Illuminate\Http\JsonResponse
    {
        if (! $token = auth()->attempt($request->validated()))
        {
            return response()->json(['error' => 'User credentials do not match'], 401);
        }
        return $this->createNewToken($token);
    }

    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    public function userProfile(): \Illuminate\Http\JsonResponse
    {
        return response()->json(auth()->user());
    }
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->createNewToken(auth()->refresh());
    }
    protected function createNewToken($token): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,   // Expires access token in defined duration = 3600s.
            'user' => auth()->user()
        ]);
    }
}
