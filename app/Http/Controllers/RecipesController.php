<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipesController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes, 200);
    }

    public function getByUserId($userId)
    {
        $recipes = Recipe::where('user_id', $userId)->get();
        return response()->json($recipes, 200);
    }
}