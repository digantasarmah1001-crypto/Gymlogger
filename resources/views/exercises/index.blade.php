@extends('layouts.app')

@section('title', 'Exercises')

@section('content')
    <h1>Exercises</h1>

    @can('admin')
        <p><a href="{{ route('exercises.create') }}" class="btn btn-primary">New exercise</a></p>
    @endcan

    <div class="grid">
        @foreach ($exercises as $exercise)
            @include('exercises._card')
        @endforeach
    </div>
@endsection