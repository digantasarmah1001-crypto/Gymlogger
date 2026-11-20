@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <h1>Register</h1>

    <form method="POST" action="{{ route('register') }}" class="card">
        @csrf

        <div class="field">
            <label for="name">Name</label>
            <input id="name" name="name" value="{{ old('name') }}">
            @error('name') <p class="error">{{ $message }}</p> @enderror
        </div>

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

        <div class="field">
            <label for="password_confirmation">Repeat password</label>
            <input id="password_confirmation" name="password_confirmation" type="password">
        </div>

        <button type="submit" class="btn-primary">Create account</button>
    </form>
@endsection
