<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'errors' => $validator->errors(),
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->makeHidden(['password']);
        return response()->json(
            [
                'success' => true,
                'message' => 'User registered',
                'user' => $user,
            ],
            Response::HTTP_OK
        );
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request['email'])->first();

        if (!$user) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Email or password are invalid',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        if (!Hash::check($request['password'], $user->password)) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Email or password are invalid',
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        if (!($token = JWTAuth::fromUser($user))) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Could not create token',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
        $user->makeHidden(['password']);
        return response()->json(
            [
                'success' => true,
                'token' => $token,
                'user' => $user,
            ],
            Response::HTTP_ACCEPTED
        );
    }
}
