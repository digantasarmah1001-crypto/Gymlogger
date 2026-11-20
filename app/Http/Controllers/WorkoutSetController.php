<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Models\WorkoutSet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutSetController extends Controller
{
    public function store(Request $request, Workout $workout)
    {
        Gate::authorize('update', $workout);

        $workout->sets()->create($this->validateSet($request));

        return back()->with('status', 'Set added.');
    }

    public function edit(WorkoutSet $set)
    {
        Gate::authorize('update', $set->workout);

        return view('sets.edit', [
            'set' => $set,
            'exercises' => Exercise::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function update(Request $request, WorkoutSet $set)
    {
        Gate::authorize('update', $set->workout);

        $set->update($this->validateSet($request));

        return redirect()->route('workouts.show', $set->workout)->with('status', 'Set updated.');
    }

    public function destroy(WorkoutSet $set)
    {
        Gate::authorize('update', $set->workout);

        $set->delete();

        return back()->with('status', 'Set deleted.');
    }

    private function validateSet(Request $request)
    {
        return $request->validate([
            'exercise_id' => ['required', 'exists:exercises,id'],
            'reps' => ['required', 'integer', 'min:1', 'max:100'],
            'weight_kg' => ['required', 'numeric', 'min:0', 'max:1000'],
        ], [], [
            'exercise_id' => 'exercise',
            'weight_kg' => 'weight',
        ]);
    }
}