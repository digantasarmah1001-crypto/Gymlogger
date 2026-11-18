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
            </tr>
            @forelse ($workout->sets as $set)
                <tr>
                    <td>{{ $set->exercise->name }}</td>
                    <td>{{ $set->reps }}</td>
                    <td>{{ $set->weight_kg }} kg</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No sets yet.</td>
                </tr>
            @endforelse
        </table>
    </div>

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