<?php

namespace Tests\Feature;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class SafetyTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_is_blocked_after_5_wrong_attempts(): void
    {
        $user = User::factory()->create();

        for ($i = 0; $i < 5; $i++) {
            $this->post('/login', ['email' => $user->email, 'password' => 'wrong']);
        }

        $this->post('/login', ['email' => $user->email, 'password' => 'wrong'])->assertStatus(429);
    }

    public function test_the_old_photo_is_deleted_when_a_new_one_is_uploaded(): void
    {
        $admin = User::factory()->admin()->create();

        $this->actingAs($admin)->post('/exercises', [
            'name' => 'Hip Thrust',
            'muscle_group' => 'Legs',
            'image' => UploadedFile::fake()->image('one.jpg'),
        ]);
        $exercise = Exercise::where('name', 'Hip Thrust')->first();
        $oldPhoto = public_path($exercise->image);
        $this->assertFileExists($oldPhoto);

        sleep(1); // the new file name uses the time in seconds

        $this->actingAs($admin)->put('/exercises/'.$exercise->id, [
            'name' => 'Hip Thrust',
            'muscle_group' => 'Legs',
            'image' => UploadedFile::fake()->image('two.jpg'),
        ]);

        $this->assertFileDoesNotExist($oldPhoto);
        $this->assertFileExists(public_path($exercise->fresh()->image));

        $this->actingAs($admin)->delete('/exercises/'.$exercise->id);
        $this->assertFileDoesNotExist(public_path($exercise->image));
    }
}
