<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkoutSetTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_owner_can_add_and_edit_a_set(): void
    {
        $workout = Workout::factory()->create();
        $exercise = Exercise::factory()->create();

        $this->actingAs($workout->user)->post('/workouts/'.$workout->id.'/sets', [
            'exercise_id' => $exercise->id,
            'reps' => 10,
            'weight_kg' => 60,
        ]);

        $set = $workout->sets()->first();
        $this->assertSame(10, $set->reps);

        $this->actingAs($workout->user)->put('/sets/'.$set->id, [
            'exercise_id' => $exercise->id,
            'reps' => 8,
            'weight_kg' => 65,
        ]);

        $this->assertSame(8, $set->fresh()->reps);
    }

    public function test_reps_must_be_between_1_and_100(): void
    {
        $workout = Workout::factory()->create();

        $this->actingAs($workout->user)->post('/workouts/'.$workout->id.'/sets', [
            'exercise_id' => Exercise::factory()->create()->id,
            'reps' => 0,
            'weight_kg' => 60,
        ])->assertSessionHasErrors('reps');
    }

    public function test_nobody_else_can_add_a_set_to_my_workout(): void
    {
        $workout = Workout::factory()->create();

        $this->actingAs(User::factory()->create())->post('/workouts/'.$workout->id.'/sets', [
            'exercise_id' => Exercise::factory()->create()->id,
            'reps' => 10,
            'weight_kg' => 60,
        ])->assertForbidden();

        $this->assertSame(0, $workout->sets()->count());
    }
}
