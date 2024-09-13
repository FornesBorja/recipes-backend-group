<?php

namespace App\Http\Controllers;

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
        // VALIDAR LOS DATOS
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // SI LA VALIDACIÓN FALLA, DEVOLVER LOS ERRORES
        if ($validator->fails()) {
            return response()->json($validator->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        // CREAR NUEVO USUARIO
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        // DEVOLVER LA RESPUESTA CON EL USUARIO Y TOKEN
        return response()->json([
            'success' => true,
            'message' => 'Usuario registrado exitosamente.',
            'user' => $user,
        ], Response::HTTP_OK);
    }
}