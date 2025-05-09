<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;


use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/navBare', function () {
    return view('layouts.navBare');
});

Route::get('/main', function () {
    return view('layouts.main');
});

// Les routes Profiles
Route::get('/auteurs', [AuthorController::class, 'index'])->name('auteurs.index');




// Les routes Recettes
Route::get('/AllRecipes', [RecipeController::class, 'index1'])->name('recette.index');
//Route::get('/recipes/{id}', [RecipeController::class, 'showDesc'])->name('recipes.show');


// Les routes ChatBot
Route::get('/chatbot', function () {
    return view('chatbot');
});

Route::post('/chatbot', [ChatbotController::class, 'respond']);



// Authentication Routes (login, register, logout, etc.)
Auth::routes();

// Profile Routes
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Dashboard after login
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Recipe routes with specific middleware
Route::resource('recipes', RecipeController::class);

// Special route for the "Add Recipe" button that checks authentication
Route::get('/add-recipe', function () {
    if (Auth::check()) {
        return redirect()->route('recipes.create');
    } else {
        return redirect()->route('login')->with('info', 'You must be logged in to add a recipe.');
    }
})->name('add-recipe');


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');


Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});


// Home route, only accessible to authenticated users
Route::middleware('auth')->get('/home', [HomeController::class, 'index'])->name('home');

