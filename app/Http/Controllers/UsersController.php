<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    public function getUserByUserId($userId)
    {
        $user = User::where('id', $userId)->first(); 

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function deleteUserById($userId)
    {
        $user = User::find($userId);

        if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
        }

    $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ], 200);
    }

    public function updateOwnUser(Request $request)
    {
        try {
            $authenticatedUser = auth()->user();

            if (!$authenticatedUser) {
                return response()->json(['error' => 'Usuario no autenticado'], 401);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|email|max:255|unique:users,email,' . $authenticatedUser->id,
                'password' => 'sometimes|string|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }

            $data = $request->only(['name', 'email', 'password']);

            if (isset($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            }

            $authenticatedUser->fill($data)->save();

            return response()->json([
                'success' => true,
                'user' => $authenticatedUser,
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error al actualizar usuario:', ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return response()->json(['error' => 'Algo salió mal: ' . $e->getMessage()], 500);
        }
    }
}