@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <h1>Log in</h1>

    <form method="POST" action="{{ route('login') }}" class="card">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}">
            @error('email') <p class="error">{{ $message }}</p> @enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input id="password" name="password" type="password">
            @error('password') <p class="error">{{ $message }}</p> @enderror
        </div>

        <button type="submit" class="btn-primary">Log in</button>
    </form>
@endsection
