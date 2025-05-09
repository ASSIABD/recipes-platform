<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Recipe;

class AuthorController extends Controller
{
        public function index()
    {
        $users = User::withCount('recipes')->get(); // ajoute recipes_count automatiquement
        return view('profiles.authors', compact('users'));
    }

    
}

