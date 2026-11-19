<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Models\WorkoutSet;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'exerciseCount' => Exercise::count(),
            'workoutCount' => Workout::count(),
            'setCount' => WorkoutSet::count(),
            'exercises' => Exercise::orderBy('name')->take(8)->get(),
        ]);
    }
}