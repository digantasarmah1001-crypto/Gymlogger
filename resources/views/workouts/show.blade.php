@extends('layouts.app')

@section('title', $workout->title)

@section('content')
    <h1>{{ $workout->title }}</h1>
    <p class="muted">{{ $workout->date->format('l d F Y') }}</p>

    @if ($workout->notes)
        <div class="card">{{ $workout->notes }}</div>
    @endif

    <div class="card">
        <h2>Sets</h2>
        <table>
            <tr>
                <th>Exercise</th>
                <th>Reps</th>
                <th>Weight</th>
                <th></th>
            </tr>
            @forelse ($workout->sets as $set)
                <tr>
                    <td>{{ $set->exercise->name }}</td>
                    <td>{{ $set->reps }}</td>
                    <td>{{ $set->weight_kg }} kg</td>
                    <td>
                        <form method="POST" action="{{ route('sets.destroy', $set) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No sets yet.</td>
                </tr>
            @endforelse
        </table>
    </div>

    <form method="POST" action="{{ route('sets.store', $workout) }}" class="card">
        @csrf
        <h2>Add a set</h2>

        <div class="field">
            <label for="exercise_id">Exercise</label>
            <select id="exercise_id" name="exercise_id">
                <option value="">Choose...</option>
                @foreach ($exercises as $exercise)
                    <option value="{{ $exercise->id }}" @selected(old('exercise_id') == $exercise->id)>{{ $exercise->name }}</option>
                @endforeach
            </select>
            @error('exercise_id') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="reps">Reps</label>
            <input id="reps" name="reps" type="number" value="{{ old('reps') }}">
            @error('reps') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="weight_kg">Weight (kg)</label>
            <input id="weight_kg" name="weight_kg" type="number" step="0.5" value="{{ old('weight_kg') }}">
            @error('weight_kg') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary">Add set</button>
    </form>

    <div class="actions">
        <a href="{{ route('workouts.edit', $workout) }}" class="btn">Edit</a>
        <form method="POST" action="{{ route('workouts.destroy', $workout) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-danger">Delete workout</button>
        </form>
    </div>

    <a href="{{ route('workouts.index') }}">Back to my workouts</a>
@endsection