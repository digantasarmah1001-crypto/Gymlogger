<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExerciseTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_the_admin_can_edit_or_delete_an_exercise(): void
    {
        $exercise = Exercise::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user)->get('/exercises/'.$exercise->id.'/edit')->assertForbidden();
        $this->actingAs($user)->delete('/exercises/'.$exercise->id)->assertForbidden();
        $this->assertModelExists($exercise);
    }

    public function test_an_exercise_used_in_a_workout_cannot_be_deleted(): void
    {
        $exercise = Exercise::factory()->create();
        WorkoutSet::factory()->for(Workout::factory())->for($exercise)->create();

        $this->actingAs(User::factory()->admin()->create())->delete('/exercises/'.$exercise->id);

        $this->assertModelExists($exercise);
    }

    public function test_the_photo_must_be_an_image(): void
    {
        $this->actingAs(User::factory()->admin()->create())->post('/exercises', [
            'name' => 'Hip Thrust',
            'muscle_group' => 'Legs',
            'image' => UploadedFile::fake()->create('notes.pdf'),
        ])->assertSessionHasErrors('image');
    }

    public function test_an_exercise_without_a_photo_shows_the_placeholder(): void
    {
        $exercise = Exercise::factory()->create(['image' => null]);

        $this->assertStringEndsWith('images/placeholder.jpg', $exercise->imageUrl());
    }
}
