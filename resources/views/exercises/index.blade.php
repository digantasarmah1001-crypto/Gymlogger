@extends('layouts.app')

@section('title', 'Exercises')

@section('content')
    <h1>Exercises</h1>

    <div class="card">
        <table>
            <tr>
                <th>Name</th>
                <th>Muscle group</th>
                <th>Equipment</th>
            </tr>
            @foreach ($exercises as $exercise)
                <tr>
                    <td><a href="{{ route('exercises.show', $exercise) }}">{{ $exercise->name }}</a></td>
                    <td><span class="badge">{{ $exercise->muscle_group }}</span></td>
                    <td>{{ $exercise->equipment }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection