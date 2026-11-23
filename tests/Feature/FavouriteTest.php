<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavouriteTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_add_and_remove_a_favourite(): void
    {
        $user = User::factory()->create();
        $exercise = Exercise::factory()->create();

        $this->actingAs($user)->post('/exercises/'.$exercise->id.'/favourite');
        $this->assertTrue($user->favouriteExercises()->whereKey($exercise->id)->exists());

        $this->actingAs($user)->post('/exercises/'.$exercise->id.'/favourite');
        $this->assertFalse($user->favouriteExercises()->whereKey($exercise->id)->exists());
    }
}
