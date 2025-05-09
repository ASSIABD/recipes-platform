<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recipe;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index1()
    {
        // Get all recipes with their authors and categories
        $recipes = Recipe::with(['user', 'category'])
            ->latest()
            ->paginate(12);

        return view('recipes.showRecipe', compact('recipes'));
    }

    public function index()
    {
        $recipes = Recipe::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        return view('recipes.index', compact('recipes'));
    }

    /**
     * Show the form for creating a new recipe
     */
    public function create()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour ajouter une recette.');
        }
        
        $categories = Category::all();
        return view('recipes.create', compact('categories'));
    }

    /**
     * Store a newly created recipe
     */
    public function store(Request $request)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('info', 'Vous devez être connecté pour ajouter une recette.');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'ingredients' => 'required|string',
        'steps' => 'required|string',
        'duration' => 'required|integer|min:1',
        'difficulty' => 'required|in:easy,medium,hard',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $recipe = new Recipe();
    $recipe->user_id = Auth::id();
    $recipe->title = $validated['title'];
    $recipe->description = $validated['description'];
    $recipe->ingredients = $validated['ingredients'];
    $recipe->steps = $validated['steps'];
    $recipe->duration = $validated['duration'];
    $recipe->difficulty = $validated['difficulty'];
    $recipe->category_id = $validated['category_id'];

    // Store image using Laravel's public disk
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // unique name
        
        // Store in public/recettes directory
        $path = $image->storeAs('recettes', $imageName, 'public');
        $recipe->image = $path; // Store just the relative path
    }

    $recipe->save();

    return redirect()->route('recipes.show', $recipe)->with('success', 'Recette créée avec succès!');
}

    /**
     * Display the specified recipe
     */
    public function show(Recipe $recipe)
    {
        $recipe->load(['user', 'category', 'comments.user']);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the recipe
     */
    public function edit(Recipe $recipe)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour modifier une recette.');
        }
        
        // Check if user is authorized to edit this recipe
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.show', $recipe)
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette recette.');
        }

        $categories = Category::all();
        return view('recipes.edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified recipe
     */
    public function update(Request $request, Recipe $recipe)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour modifier une recette.');
        }
        
        // Check if user is authorized to update this recipe
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.show', $recipe)
                ->with('error', 'Vous n\'êtes pas autorisé à modifier cette recette.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'duration' => 'required|integer|min:1',
            'difficulty' => 'required|in:easy,medium,hard',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe->title = $validated['title'];
        $recipe->description = $validated['description'];
        $recipe->ingredients = $validated['ingredients'];
        $recipe->steps = $validated['steps'];
        $recipe->duration = $validated['duration'];
        $recipe->difficulty = $validated['difficulty'];
        $recipe->category_id = $validated['category_id'];

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($recipe->image) {
                Storage::disk('public')->delete($recipe->image);
            }
            
            $imagePath = $request->file('image')->store('recipe-images', 'public');
            $recipe->image = $imagePath;
        }

        $recipe->save();

        return redirect()->route('recipes.show', $recipe)->with('success', 'Recette mise à jour avec succès!');
    }

    /**
     * Remove the specified recipe
     */
    public function destroy(Recipe $recipe)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('info', 'Vous devez être connecté pour supprimer une recette.');
        }
        
        // Check if user is authorized to delete this recipe
        if (Auth::id() !== $recipe->user_id) {
            return redirect()->route('recipes.show', $recipe)
                ->with('error', 'Vous n\'êtes pas autorisé à supprimer cette recette.');
        }

        // Delete associated image if exists
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }

        $recipe->delete();

        return redirect()->route('recipes.index')->with('success', 'Recette supprimée avec succès!');
    }
}
