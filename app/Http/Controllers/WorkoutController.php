<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Workout::with('user:id,name')->withCount('sets')->latest('date');

        if (! $request->user()->is_admin) {
            $query->where('user_id', $request->user()->id);
        }

        return view('workouts.index', ['workouts' => $query->get()]);
    }

    public function create()
    {
        return view('workouts.create', ['workout' => new Workout(['date' => today()])]);
    }

    public function store(Request $request)
    {
        $workout = $request->user()->workouts()->create($this->validateWorkout($request));

        return redirect()->route('workouts.show', $workout)->with('status', 'Workout saved. Now add your sets.');
    }

    public function show(Workout $workout)
    {
        Gate::authorize('view', $workout);

        $workout->load('sets.exercise:id,name');

        return view('workouts.show', [
            'workout' => $workout,
            'exercises' => Exercise::orderBy('name')->get(['id', 'name']),
        ]);
    }

    public function edit(Workout $workout)
    {
        Gate::authorize('update', $workout);

        return view('workouts.edit', ['workout' => $workout]);
    }

    public function update(Request $request, Workout $workout)
    {
        Gate::authorize('update', $workout);

        $workout->update($this->validateWorkout($request));

        return redirect()->route('workouts.show', $workout)->with('status', 'Workout updated.');
    }

    public function destroy(Workout $workout)
    {
        Gate::authorize('delete', $workout);

        $workout->delete();

        return redirect()->route('workouts.index')->with('status', 'Workout deleted.');
    }

    private function validateWorkout(Request $request)
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:100'],
            'date' => ['required', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ], [
            'date.before_or_equal' => "You can't log a workout in the future.",
        ]);
    }
}