@extends('layouts.app')

@section('title', 'Suggestions')

@section('content')
    <h1>Suggestions</h1>
    <p class="muted">Exercises added by users. Approve one to show it to everyone.</p>

    @if ($exercises->isEmpty())
        <p class="muted">No suggestions right now.</p>
    @else
        <div class="card">
            <table>
                <tr>
                    <th>Exercise</th>
                    <th>Muscle group</th>
                    <th>Added by</th>
                    <th></th>
                </tr>
                @foreach ($exercises as $exercise)
                    <tr>
                        <td><a href="{{ route('exercises.show', $exercise) }}">{{ $exercise->name }}</a></td>
                        <td>{{ $exercise->muscle_group }}</td>
                        <td>{{ $exercise->user?->name ?? 'Deleted user' }}</td>
                        <td>
                            <form method="POST" action="{{ route('suggestions.approve', $exercise) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-primary">Approve</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endif
@endsection