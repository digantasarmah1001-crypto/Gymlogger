<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        $data = $this->validateExercise($request);
        $data['image'] = $this->storeImage($request);

        $exercise = Exercise::create($data);

        return redirect()->route('exercises.show', $exercise)->with('status', 'Exercise added.');
    }

    public function show(Exercise $exercise)
    {
        $myBest = null;

        if (auth()->check()) {
            $myBest = $exercise->sets()->whereRelation('workout', 'user_id', auth()->id())->max('weight_kg');
        }

        return view('exercises.show', [
            'exercise' => $exercise,
            'myBest' => $myBest,
            'timesLogged' => $exercise->sets()->count(),
        ]);
    }

    public function edit(Exercise $exercise)
    {
        return view('exercises.edit', ['exercise' => $exercise]);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $data = $this->validateExercise($request, $exercise);
        $data['image'] = $this->storeImage($request) ?? $exercise->image;

        $exercise->update($data);

        return redirect()->route('exercises.show', $exercise)->with('status', 'Exercise updated.');
    }

    public function destroy(Exercise $exercise)
    {
        if ($exercise->sets()->exists()) {
            return back()->with('error', "This exercise is used in workouts, so it can't be deleted.");
        }

        $exercise->delete();

        return redirect()->route('exercises.index')->with('status', 'Exercise deleted.');
    }

    private function validateExercise(Request $request, ?Exercise $exercise = null)
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('exercises')->ignore($exercise)],
            'muscle_group' => ['required', Rule::in(Exercise::MUSCLE_GROUPS)],
            'equipment' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:1000'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);
    }

    private function storeImage(Request $request): ?string
    {
        if (! $request->hasFile('image')) {
            return null;
        }

        $file = $request->file('image');
        $name = Str::slug($request->input('name')).'-'.time().'.'.$file->extension();
        $file->move(public_path('uploads/exercises'), $name);

        return 'uploads/exercises/'.$name;
    }
}