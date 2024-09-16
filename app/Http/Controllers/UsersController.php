<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // <-- Asegúrate de importar el modelo correcto
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function getUserByUserId($userId)
    {
        // Busca al usuario por el campo "userId"
        $user = User::where('id', $userId)->first(); // <-- Asegúrate de que "id" es el campo correcto

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user, 200);
    }

    public function deleteUserById($userId) // Cambié recipeId a userId
{
    // Encuentra el usuario por el ID proporcionado
    $user = User::find($userId);

    // Si el usuario no existe, devuelve un error 404
    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    // Elimina el usuario
    $user->delete();

    // Devuelve una respuesta de éxito
    return response()->json([
        'success' => true,
        'message' => 'User deleted successfully',
    ], 200);
}

}
    