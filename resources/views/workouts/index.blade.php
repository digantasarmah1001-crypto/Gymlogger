@extends('layouts.app')

@section('title', 'My workouts')

@section('content')
    <h1>{{ auth()->user()->is_admin ? 'All workouts' : 'My workouts' }}</h1>

    <p><a href="{{ route('workouts.create') }}" class="btn btn-primary">New workout</a></p>

    <div class="card">
        <table>
            <tr>
                <th>Date</th>
                <th>Workout</th>
                <th>Athlete</th>
                <th>Sets</th>
            </tr>
            @forelse ($workouts as $workout)
                <tr>
                    <td>{{ $workout->date->format('d M Y') }}</td>
                    <td><a href="{{ route('workouts.show', $workout) }}">{{ $workout->title }}</a></td>
                    <td>{{ $workout->user->name }}</td>
                    <td>{{ $workout->sets_count }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No workouts yet.</td>
                </tr>
            @endforelse
        </table>
    </div>
@endsection