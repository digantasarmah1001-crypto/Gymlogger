<?php

namespace App\Http\Controllers;

use App\Models\Exercise;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::orderBy('muscle_group')->orderBy('name')->get();

        return view('exercises.index', ['exercises' => $exercises]);
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', ['exercise' => $exercise]);
    }
}