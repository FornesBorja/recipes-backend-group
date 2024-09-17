<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes, 200);
    }

    public function getOwnRecipes()
    {
    $user = JWTAuth::parseToken()->authenticate();

    if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

    $recipes = Recipe::where('user_id', $user->id)->get();

    return response()->json($recipes, 200);
}

    public function getRecipeByUserId($userId)
    {
        $recipes = Recipe::where('user_id', $userId)->get();
        return response()->json($recipes, 200);
    }

    public function createRecipe(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
        return response()->json(['error' => 'User not found'], 404);
    }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'instructions' => 'required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $recipe = Recipe::create(array_merge(
            $request->all(),
            ['user_id' => $user->id]
        ));

        return response()->json([
            'success' => true,
            'recipe' => $recipe,
        ], 201);
    }

    public function updateOwnRecipe(Request $request, $recipeId)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $recipe = Recipe::find($recipeId);

        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        if ($recipe->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'sometimes|required|string|max:255',
            'ingredients' => 'sometimes|required|string',
            'instructions' => 'sometimes|required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $recipe->update($request->only([
            'title', 'ingredients', 'instructions', 'prep_time', 'cook_time', 'servings'
        ]));

        $recipe->update($request->all());

        return response()->json([
            'success' => true,
            'recipe' => $recipe,
        ], 200);
    }

    public function deleteOwnRecipe($recipeId)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $recipe = Recipe::find($recipeId);

        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        if ($recipe->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $recipe->delete();

        return response()->json([
            'success' => true,
            'message' => 'Recipe deleted successfully',
        ], 200);
    }

    public function deleteRecipeById($recipeId)
    {
        $recipe = Recipe::find($recipeId);

        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        $recipe->delete();

        return response()->json([
            'success' => true,
            'message' => 'Recipe deleted successfully',
        ], 200);
    }
}