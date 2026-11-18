@extends('layouts.app')

@section('title', 'Edit workout')

@section('content')
    <h1>Edit workout</h1>

    <form method="POST" action="{{ route('workouts.update', $workout) }}" class="card">
        @csrf
        @method('PUT')
        @include('workouts._form')
        <button type="submit" class="btn-primary">Save</button>
    </form>
@endsection