    <nav class="nav">
        <div class="container">
            <a href="{{ route('home') }}" class="brand">Gym<span>logger</span></a>
            <a href="{{ route('exercises.index') }}">Exercises</a>
            @auth
                <span class="user">Hi, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="link">Log out</button>
                </form>
            @else
                <a href="{{ route('login') }}">Log in</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </nav>