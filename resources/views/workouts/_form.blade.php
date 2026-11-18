<div class="field">
    <label for="title">Title</label>
    <input id="title" name="title" value="{{ old('title', $workout->title) }}" placeholder="Leg day">
    @error('title') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="date">Date</label>
    <input id="date" name="date" type="date" value="{{ old('date', $workout->date?->format('Y-m-d')) }}">
    @error('date') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="notes">Notes</label>
    <textarea id="notes" name="notes" rows="3">{{ old('notes', $workout->notes) }}</textarea>
    @error('notes') <p class="error">{{ $message }}</p> @enderror
</div>