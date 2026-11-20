<?php

namespace App\Models;

use App\Models\Concerns\ClearsWelcomeCache;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'muscle_group', 'equipment', 'description', 'image'])]
class Exercise extends Model
{
    use ClearsWelcomeCache, HasFactory;

    public const MUSCLE_GROUPS = ['Chest', 'Back', 'Legs', 'Shoulders', 'Arms', 'Core'];

    public function sets(): HasMany
    {
        return $this->hasMany(WorkoutSet::class);
    }

    public function favouritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function imageUrl(): string
    {
        return asset($this->image ?? 'images/placeholder.jpg');
    }
}