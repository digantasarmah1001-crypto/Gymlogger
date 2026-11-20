@extends('layouts.app')

@section('title', 'Exercises')

@section('content')
    <h1>Exercises</h1>

    @auth
        <p><a href="{{ route('exercises.create') }}" class="btn btn-primary">New exercise</a></p>
        <p class="muted">Missing an exercise? Add it yourself. You can use it right away, and everyone sees it once the admin approves it.</p>
    @endauth

    <div class="grid">
        @foreach ($exercises as $exercise)
            @include('exercises._card')
        @endforeach
    </div>
@endsection