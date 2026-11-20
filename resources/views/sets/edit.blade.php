@extends('layouts.app')

@section('title', 'Edit set')

@section('content')
    <h1>Edit set</h1>
    <p class="muted">{{ $set->workout->title }}, {{ $set->workout->date->format('d M Y') }}</p>

    <form method="POST" action="{{ route('sets.update', $set) }}" class="card">
        @csrf
        @method('PUT')

        <div class="field">
            <label for="exercise_id">Exercise</label>
            <select id="exercise_id" name="exercise_id">
                @foreach ($exercises as $exercise)
                    <option value="{{ $exercise->id }}" @selected(old('exercise_id', $set->exercise_id) == $exercise->id)>{{ $exercise->name }}</option>
                @endforeach
            </select>
            @error('exercise_id') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="reps">Reps</label>
            <input id="reps" name="reps" type="number" value="{{ old('reps', $set->reps) }}">
            @error('reps') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="weight_kg">Weight (kg)</label>
            <input id="weight_kg" name="weight_kg" type="number" step="0.5" value="{{ old('weight_kg', $set->weight_kg) }}">
            @error('weight_kg') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary">Save</button>
    </form>

    <a href="{{ route('workouts.show', $set->workout) }}">Back to the workout</a>
@endsection