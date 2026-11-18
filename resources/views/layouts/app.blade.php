<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>@yield('title', 'Gymlogger')</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?
family=Archivo:wght@400;600&family=Big+Shoulders+Display:wght@800&display=swap">
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<nav class="nav">
<div class="container">
<a href="{{ route('home') }}" class="brand">Gym<span>logger</span></a>
</div>
</nav>
<main class="container">
@if (session('status'))
<p class="flash">{{ session('status') }}</p>
@endif
@if (session('error'))
<p class="flash flash-error">{{ session('error') }}</p>
@endif
@yield('content')
</main>
</body>
</html>