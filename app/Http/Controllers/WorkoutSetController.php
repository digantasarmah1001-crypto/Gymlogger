<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutSetController extends Controller
{
    public function store(Request $request, Workout $workout)
    {
        Gate::authorize('update', $workout);

        $validated = $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
            'reps' => ['required', 'integer', 'min:1', 'max:100'],
            'weight_kg' => ['required', 'numeric', 'min:0', 'max:1000'],
        ], [], [
            'exercise_id' => 'exercise',
            'weight_kg' => 'weight',
        ]);

        $workout->sets()->create($validated);

        return back()->with('status', 'Set added.');
    }

    public function destroy(WorkoutSet $set)
    {
        Gate::authorize('update', $set->workout);

        $set->delete();

        return back()->with('status', 'Set deleted.');
    }
}