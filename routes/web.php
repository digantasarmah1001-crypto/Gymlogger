<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\FavouriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutSetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/credits', [HomeController::class, 'credits'])->name('credits');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('workouts', WorkoutController::class);
    Route::post('/workouts/{workout}/sets', [WorkoutSetController::class, 'store'])->name('sets.store');
    Route::get('/sets/{set}/edit', [WorkoutSetController::class, 'edit'])->name('sets.edit');
    Route::put('/sets/{set}', [WorkoutSetController::class, 'update'])->name('sets.update');
    Route::delete('/sets/{set}', [WorkoutSetController::class, 'destroy'])->name('sets.destroy');
    Route::get('/favourites', [FavouriteController::class, 'index'])->name('favourites.index');
    Route::post('/exercises/{exercise}/favourite', [FavouriteController::class, 'toggle'])->name('favourites.toggle');
    Route::resource('exercises', ExerciseController::class)->only(['create', 'store']);
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('exercises', ExerciseController::class)->only(['edit', 'update', 'destroy']);
    Route::get('/suggestions', [SuggestionController::class, 'index'])->name('suggestions.index');
    Route::patch('/exercises/{exercise}/approve', [SuggestionController::class, 'approve'])->name('suggestions.approve');
});

Route::resource('exercises', ExerciseController::class)->only(['index', 'show']);