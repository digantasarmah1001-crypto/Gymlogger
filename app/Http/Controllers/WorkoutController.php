<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkoutController extends Controller
{
    public function index(Request $request)
    {
        $query = Workout::with('user')->withCount('sets')->latest('date');

        if (! $request->user()->is_admin) {
            $query->where('user_id', $request->user()->id);
        }

        return view('workouts.index', ['workouts' => $query->get()]);
    }

    public function show(Workout $workout)
    {
        Gate::authorize('view', $workout);

        $workout->load('sets.exercise');

        return view('workouts.show', ['workout' => $workout]);
    }
}