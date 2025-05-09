<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = auth()->user()->favoriteRecipes()->get();
        return view('favorites.index', compact('favorites'));
    }

    public function toggleFavorite($recipeId)
    {
        $recipe = Recipe::findOrFail($recipeId);
        
        // Get the current favorite status
        $isFavorited = auth()->user()->favoriteRecipes()->where('recipe_id', $recipeId)->exists();
        
        // Toggle the favorite status
        auth()->user()->favoriteRecipes()->toggle($recipe);
        
        // Return the new status
        return response()->json([
            'status' => 'success',
            'favorited' => !$isFavorited // The new status is the opposite of the previous status
        ]);
    }
}
