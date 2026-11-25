<?php

namespace App\Models;

use App\Models\Concerns\ClearsWelcomeCache;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'muscle_group', 'equipment', 'description', 'image'])]
class Exercise extends Model
{
    use ClearsWelcomeCache, HasFactory;

    public const MUSCLE_GROUPS = ['Chest', 'Back', 'Legs', 'Shoulders', 'Arms', 'Core'];

    protected $attributes = [
        'is_approved' => true,
    ];

    protected function casts(): array
    {
        return [
            'is_approved' => 'boolean',
        ];
    }

    // The user who added this exercise.
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function sets(): HasMany
    {
        return $this->hasMany(WorkoutSet::class);
    }

    public function favouritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    // Approved exercises, plus the ones this user added themselves.
    public function scopeVisibleTo(Builder $query, ?User $user): void
    {
        $query->where(function (Builder $query) use ($user) {
            $query->where('is_approved', true);

            if ($user) {
                $query->orWhere('user_id', $user->id);
            }
        });
    }

    public function isVisibleTo(?User $user): bool
    {
        if ($this->is_approved) {
            return true;
        }

        return $user && ($user->is_admin || $this->user_id === $user->id);
    }

    public function imageUrl(): string
    {
        return asset($this->image ?? 'images/placeholder.jpg');
    }
}
