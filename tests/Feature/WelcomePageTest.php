<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_welcome_page_makes_no_queries_once_it_is_cached(): void
    {
        $this->get('/')->assertOk();

        DB::enableQueryLog();
        $this->get('/')->assertOk();

        $this->assertCount(0, DB::getQueryLog());
    }

    public function test_the_cache_is_cleared_when_a_workout_is_added(): void
    {
        $this->get('/')->assertViewHas('workoutCount', 0);

        Workout::factory()->for(User::factory())->create();

        $this->get('/')->assertViewHas('workoutCount', 1);
    }
}
