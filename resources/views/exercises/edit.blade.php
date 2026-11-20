@extends('layouts.app')

@section('title', 'Edit exercise')

@section('content')
    <h1>Edit {{ $exercise->name }}</h1>

    <form method="POST" action="{{ route('exercises.update', $exercise) }}" class="card" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('exercises._form')
        <button type="submit" class="btn-primary">Save</button>
    </form>
@endsection