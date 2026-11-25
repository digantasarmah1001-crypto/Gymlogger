<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ExerciseController extends Controller
{
    public function index()
    {
        $exercises = Exercise::visibleTo(auth()->user())->orderBy('muscle_group')->orderBy('name')->get();

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

        $exercise = new Exercise($data);
        $exercise->user_id = $request->user()->id;
        $exercise->is_approved = $request->user()->is_admin;
        $exercise->save();

        $message = $exercise->is_approved
            ? 'Exercise added.'
            : 'Exercise added. Only you can see it until the admin approves it.';

        return redirect()->route('exercises.show', $exercise)->with('status', $message);
    }

    public function show(Exercise $exercise)
    {
        abort_unless($exercise->isVisibleTo(auth()->user()), 404);

        $myBest = null;
        $isFavourite = false;

        if (auth()->check()) {
            $myBest = $exercise->sets()->whereRelation('workout', 'user_id', auth()->id())->max('weight_kg');
            $isFavourite = auth()->user()->favouriteExercises()->whereKey($exercise->id)->exists();
        }

        return view('exercises.show', [
            'exercise' => $exercise,
            'myBest' => $myBest,
            'timesLogged' => $exercise->sets()->count(),
            'isFavourite' => $isFavourite,
        ]);
    }

    public function edit(Exercise $exercise)
    {
        return view('exercises.edit', ['exercise' => $exercise]);
    }

    public function update(Request $request, Exercise $exercise)
    {
        $data = $this->validateExercise($request, $exercise);
        $newImage = $this->storeImage($request);

        if ($newImage) {
            $this->deleteUploadedImage($exercise->image);
        }

        $data['image'] = $newImage ?? $exercise->image;
        $exercise->update($data);

        return redirect()->route('exercises.show', $exercise)->with('status', 'Exercise updated.');
    }

    public function destroy(Exercise $exercise)
    {
        if ($exercise->sets()->exists()) {
            return back()->with('error', "This exercise is used in workouts, so it can't be deleted.");
        }

        $exercise->delete();
        $this->deleteUploadedImage($exercise->image);

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
        ], [
            'name.unique' => 'There is already an exercise with this name.',
            'muscle_group.in' => 'Choose a muscle group from the list.',
            'image.max' => 'The photo can be at most 2 MB.',
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

    // Only delete photos users uploaded, never the built-in ones in public/images.
    private function deleteUploadedImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'uploads/')) {
            File::delete(public_path($path));
        }
    }
}
