@extends('layouts.app')
@section('content')
<div class="hero">
<h1>Log every rep.</h1>
<p>Gymlogger is a simple workout tracker. Log your workouts, add your sets and see
your best lifts.</p>
</div>
<div class="stats">
<div class="stat"><strong>{{ $exerciseCount }}</strong> exercises</div>
<div class="stat"><strong>{{ $workoutCount }}</strong> workouts logged</div>
<div class="stat"><strong>{{ $setCount }}</strong> sets done</div>
</div>
@endsection