<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WorkoutController;
use App\Http\Controllers\WorkoutSetController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

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
    Route::delete('/sets/{set}', [WorkoutSetController::class, 'destroy'])->name('sets.destroy');
});

Route::middleware(['auth', 'can:admin'])->group(function () {
    Route::resource('exercises', ExerciseController::class)->except(['index', 'show']);
});

Route::resource('exercises', ExerciseController::class)->only(['index', 'show']);