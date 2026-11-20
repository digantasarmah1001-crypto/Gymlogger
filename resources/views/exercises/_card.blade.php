<a href="{{ route('exercises.show', $exercise) }}" class="exercise-card">
    <img src="{{ $exercise->imageUrl() }}" alt="{{ $exercise->name }}">
    <div>
        <strong>{{ $exercise->name }}</strong>
        <span class="badge">{{ $exercise->muscle_group }}</span>
        @unless ($exercise->is_approved)
            <span class="badge badge-pending">Waiting for approval</span>
        @endunless
    </div>
</a>