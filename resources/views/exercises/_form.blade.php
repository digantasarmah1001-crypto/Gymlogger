<div class="field">
    <label for="name">Name</label>
    <input id="name" name="name" value="{{ old('name', $exercise->name) }}">
    @error('name') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="muscle_group">Muscle group</label>
    <select id="muscle_group" name="muscle_group">
        <option value="">Choose...</option>
        @foreach (App\Models\Exercise::MUSCLE_GROUPS as $group)
            <option value="{{ $group }}" @selected(old('muscle_group', $exercise->muscle_group) === $group)>{{ $group }}</option>
        @endforeach
    </select>
    @error('muscle_group') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="equipment">Equipment</label>
    <input id="equipment" name="equipment" value="{{ old('equipment', $exercise->equipment) }}">
    @error('equipment') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="description">Description</label>
    <textarea id="description" name="description" rows="3">{{ old('description', $exercise->description) }}</textarea>
    @error('description') <p class="error">{{ $message }}</p> @enderror
</div>

<div class="field">
    <label for="image">Photo (jpg, png or webp, max 2 MB)</label>
    <input id="image" name="image" type="file" accept="image/*">
    @if ($exercise->image)
        <p class="muted">Leave empty to keep the current photo.</p>
    @endif
    @error('image') <p class="error">{{ $message }}</p> @enderror
</div>