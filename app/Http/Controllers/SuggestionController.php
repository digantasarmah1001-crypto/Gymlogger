<?php

namespace App\Http\Controllers;

use App\Models\Exercise;

class SuggestionController extends Controller
{
    public function index()
    {
        $exercises = Exercise::with('user:id,name')->where('is_approved', false)->latest()->get();

        return view('suggestions.index', ['exercises' => $exercises]);
    }

    public function approve(Exercise $exercise)
    {
        $exercise->is_approved = true;
        $exercise->save();

        return back()->with('status', $exercise->name.' is now visible to everyone.');
    }
}
