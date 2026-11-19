@extends('layouts.app')

@section('title', 'Photo credits')

@section('content')
    <h1>Photo credits</h1>
    <p class="muted">All photos are free to use under the licence shown. They were resized for the web.</p>

    <div class="card">
        <table>
            <tr>
                <th>Photo</th>
                <th>By</th>
                <th>Licence</th>
            </tr>
            @foreach ($photos as [$photo, $author, $licence, $link])
                <tr>
                    <td><a href="{{ $link }}">{{ $photo }}</a></td>
                    <td>{{ $author }}</td>
                    <td>{{ $licence }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection