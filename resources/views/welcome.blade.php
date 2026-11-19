@extends('layouts.app')

@section('content')
    <div class="hero">
        <h1>Log every rep.</h1>
        <p>Gymlogger is a simple workout tracker. Log your workouts, add your sets and see your best lifts.</p>

        <div class="actions">
            @auth
                <a href="{{ route('workouts.index') }}" class="btn btn-primary">My workouts</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary">Create account</a>
                <a href="{{ route('login') }}" class="btn">Log in</a>
            @endauth
        </div>
    </div>

    <div class="stats">
        <div class="stat"><strong>{{ $exerciseCount }}</strong> exercises</div>
        <div class="stat"><strong>{{ $workoutCount }}</strong> workouts logged</div>
        <div class="stat"><strong>{{ $setCount }}</strong> sets done</div>
    </div>

    <h2>Exercises</h2>

    <div class="grid">
        @foreach ($exercises as $exercise)
            @include('exercises._card')
        @endforeach
    </div>

    <p><a href="{{ route('exercises.index') }}" class="btn">See all exercises</a></p>
@endsection