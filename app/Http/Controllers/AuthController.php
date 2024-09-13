<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
        'name' => 'required|string',
        'email' => 'required|string|unique:users,email',
        'password' => 'required|string|min:6|max:12',
        ]);

        $user = User::create([
        'name' => $request['name'],
        'email' => $request['email'],
        'role_id' => self::ROLE_USER,
        'password' => bcrypt($request['password'])
        ]);

        return response($res, Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|string',
        'password' => 'required|string',
        ]);
        $user = User::query()->where('email', $request['email'])->first();
        // Validamos si el usuario existe
        if (!$user) {
            return response(
                ["success" => false, "message" => "Email or password are invalid",], Response::HTTP_NOT_FOUND);
        }
        // Validamos la contraseña
        if (!Hash::check($request['password'], $user->password)) {
            return response(["success" => true, "message" => "Email or password are invalid"], Response::HTTP_NOT_FOUND);
        }
        $token = $user->createToken('apiToken')->plainTextToken;
        $res = ["success" => true, "message" => "User logged successfully", "token" => $token];

        return response($res, Response::HTTP_ACCEPTED);
    }

    public function logout(Request $request)
    {
        $accessToken = $request->bearerToken();
        // Get access token from database
        $token = PersonalAccessToken::findToken($accessToken);
        // Revoke token
        $token->delete();

        return response(
            [
                "success" => true,
                "message" => "Logout successfully"
            ],
            Response::HTTP_OK
        );
    }

    public function profile()
    {
        $user = auth()->user();

        return response(
            [
                "success" => true,
                "message" => "User profile get succsessfully",
                "data" => $user
            ],
            Response::HTTP_OK
        );
    }
}