<a href="{{ route('exercises.show', $exercise) }}" class="exercise-card">
    @if ($exercise->image)
        <img src="{{ asset($exercise->image) }}" alt="{{ $exercise->name }}">
    @else
        <span class="no-photo">{{ $exercise->muscle_group }}</span>
    @endif
    <div>
        <strong>{{ $exercise->name }}</strong>
        <span class="badge">{{ $exercise->muscle_group }}</span>
    </div>
</a>