<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function index(Request $request)
    {
        $exercises = $request->user()->favouriteExercises()->orderBy('name')->get();

        return view('favourites.index', ['exercises' => $exercises]);
    }

    public function toggle(Request $request, Exercise $exercise)
    {
        $result = $request->user()->favouriteExercises()->toggle($exercise);

        $message = $result['attached'] ? 'Added to your favourites.' : 'Removed from your favourites.';

        return back()->with('status', $message);
    }
}