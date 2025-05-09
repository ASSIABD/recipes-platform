<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get the user's recipes
        $userRecipes = Recipe::where('user_id', auth()->id())
                            ->latest()
                            ->take(5)
                            ->get();
        
        return view('home', compact('userRecipes'));
    }
}