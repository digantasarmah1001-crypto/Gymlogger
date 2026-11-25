<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SuggestionTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_add_an_exercise_that_waits_for_approval(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/exercises', [
            'name' => 'Hip Thrust',
            'muscle_group' => 'Legs',
        ]);

        $exercise = Exercise::where('name', 'Hip Thrust')->first();
        $this->assertFalse($exercise->is_approved);
        $this->assertSame($user->id, $exercise->user_id);
    }

    public function test_others_cannot_see_an_exercise_before_it_is_approved(): void
    {
        $exercise = $this->suggestion();

        $this->get('/exercises')->assertDontSee('Hip Thrust');
        $this->get('/exercises/'.$exercise->id)->assertNotFound();
        $this->actingAs(User::factory()->create())->get('/exercises/'.$exercise->id)->assertNotFound();
        $this->actingAs($exercise->user)->get('/exercises/'.$exercise->id)->assertOk();
    }

    public function test_the_admin_can_approve_a_suggestion(): void
    {
        $exercise = $this->suggestion();
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->get('/suggestions')->assertSee('Hip Thrust');
        $this->actingAs($admin)->patch('/exercises/'.$exercise->id.'/approve');

        $this->assertTrue($exercise->fresh()->is_approved);
        $this->get('/exercises')->assertSee('Hip Thrust');
    }

    public function test_a_normal_user_cannot_approve(): void
    {
        $exercise = $this->suggestion();

        $this->actingAs($exercise->user)->patch('/exercises/'.$exercise->id.'/approve')->assertForbidden();
        $this->assertFalse($exercise->fresh()->is_approved);
    }

    private function suggestion(): Exercise
    {
        $exercise = new Exercise(['name' => 'Hip Thrust', 'muscle_group' => 'Legs']);
        $exercise->user_id = User::factory()->create()->id;
        $exercise->is_approved = false;
        $exercise->save();

        return $exercise;
    }
}
