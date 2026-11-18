@extends('layouts.app')

@section('title', 'New workout')

@section('content')
    <h1>New workout</h1>

    <form method="POST" action="{{ route('workouts.store') }}" class="card">
        @csrf
        @include('workouts._form')
        <button type="submit" class="btn-primary">Save</button>
    </form>
@endsection