<?php

namespace App\Models;

use App\Models\Concerns\ClearsWelcomeCache;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['exercise_id', 'reps', 'weight_kg'])]
class WorkoutSet extends Model
{
    use ClearsWelcomeCache, HasFactory;

    protected function casts(): array
    {
        return [
            'weight_kg' => 'float',
        ];
    }

    public function workout(): BelongsTo
    {
        return $this->belongsTo(Workout::class);
    }

    public function exercise(): BelongsTo
    {
        return $this->belongsTo(Exercise::class);
    }
}