<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WorkoutTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_log_a_workout(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/workouts', [
            'title' => 'Leg day',
            'date' => now()->format('Y-m-d'),
        ]);

        $this->assertSame('Leg day', $user->workouts()->first()->title);
    }

    public function test_a_workout_cannot_be_in_the_future(): void
    {
        $this->actingAs(User::factory()->create())->post('/workouts', [
            'title' => 'Leg day',
            'date' => now()->addDay()->format('Y-m-d'),
        ])->assertSessionHasErrors('date');
    }

    public function test_users_cannot_see_each_others_workouts(): void
    {
        $workout = Workout::factory()->create();

        $this->actingAs(User::factory()->create())->get('/workouts/'.$workout->id)->assertForbidden();
        $this->actingAs($workout->user)->get('/workouts/'.$workout->id)->assertOk();
    }

    public function test_the_admin_can_see_every_workout(): void
    {
        $workout = Workout::factory()->create();

        $this->actingAs(User::factory()->admin()->create())->get('/workouts/'.$workout->id)->assertOk();
    }
}
