@extends('layouts.app')

@section('title', 'New exercise')

@section('content')
    <h1>New exercise</h1>

    <form method="POST" action="{{ route('exercises.store') }}" class="card" enctype="multipart/form-data">
        @csrf
        @include('exercises._form')
        <button type="submit" class="btn-primary">Save</button>
    </form>
@endsection