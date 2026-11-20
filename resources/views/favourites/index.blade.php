@extends('layouts.app')

@section('title', 'My favourites')

@section('content')
    <h1>My favourites</h1>

    @if ($exercises->isEmpty())
        <p class="muted">No favourites yet. Open an exercise and click "Add to favourites".</p>
    @else
        <div class="grid">
            @foreach ($exercises as $exercise)
                @include('exercises._card')
            @endforeach
        </div>
    @endif
@endsection
