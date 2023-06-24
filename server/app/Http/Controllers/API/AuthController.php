<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AuthRequest;
use App\Http\Requests\API\LoginRequest;
use App\Http\Requests\API\LogoutRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(AuthRequest $request): JsonResponse
    {
        try {

            $user = User::create([
                'first_name' => $request->get('first_name'),
                'last_name' => $request->get('last_name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);

            $token = $user->createToken('user_token')->plainTextToken;

            return new JsonResponse([
                'user' => $user,
                'token' => $token
            ], 200);
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong'
            ]);
        }
    }

    public function login(LoginRequest $request): JsonResponse
    {
        try {

            $user = User::where('email', '=', $request->get('email'))->firstOrFail();

            if (Hash::check($request->get('password'), $user->password)) {
                $token = $user->createToken('user_token')->plainTextToken;
                return new JsonResponse([
                    'user' => $user,
                    'token' => $token
                ], 200);
            }

            return new JsonResponse([
                'error' => 'Something went wrong in login'
            ], 500);
        } catch (Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong'
            ], 500);
        }
    }

    public function logout(LogoutRequest $request): JsonResponse
    {
        try {

            $user = User::findOrFail($request->get('user_id'));

            $user->tokens()->delete();

            return new JsonResponse('User logged out!', 200);
        } catch (\Exception $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
                'message' => 'Something went wrong'
            ]);
        }
    }
}
