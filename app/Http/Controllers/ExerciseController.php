<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::orderBy('muscle_group')->orderBy('name')->get();

        return view('exercises.index', ['exercises' => $exercises]);
    }

    public function create()
    {
        return view('exercises.create', ['exercise' => new Exercise]);
    }

    public function store(Request $request)
    {
        $exercise = Exercise::create($this->validateExercise($request));

        return redirect()->route('exercises.show', $exercise)->with('status', 'Exercise added.');
    }

    public function show(Exercise $exercise)
    {
        return view('exercises.show', ['exercise' => $exercise]);
    }

    private function validateExercise(Request $request, ?Exercise $exercise = null)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('exercises')->ignore($exercise)],
            'muscle_group' => ['required', Rule::in(Exercise::MUSCLE_GROUPS)],
            'equipment' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);
    }
}