@extends('layouts.app')

@section('title', $exercise->name)

@section('content')
    <h1>{{ $exercise->name }}</h1>

    <div class="card">
        <p><span class="badge">{{ $exercise->muscle_group }}</span> {{ $exercise->equipment }}</p>
        <p>{{ $exercise->description }}</p>
    </div>

    <div class="stats">
        <div class="stat"><strong>{{ $timesLogged }}</strong> sets logged by everyone</div>
        @auth
            <div class="stat"><strong>{{ $myBest ?? '-' }}</strong> kg is your best</div>
        @endauth
    </div>

    @can('admin')
        <div class="actions">
            <a href="{{ route('exercises.edit', $exercise) }}" class="btn">Edit</a>
            <form method="POST" action="{{ route('exercises.destroy', $exercise) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-danger">Delete</button>
            </form>
        </div>
    @endcan

    <a href="{{ route('exercises.index') }}">Back to all exercises</a>
@endsection