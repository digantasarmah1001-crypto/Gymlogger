@extends('layouts.app')

@section('title', $exercise->name)

@section('content')
    <h1>{{ $exercise->name }}</h1>

    <div class="card">
        <p><span class="badge">{{ $exercise->muscle_group }}</span> {{ $exercise->equipment }}</p>
        <p>{{ $exercise->description }}</p>
    </div>

    <a href="{{ route('exercises.index') }}">Back to all exercises</a>
@endsection