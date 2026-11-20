<?php

namespace Database\Seeders;

use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use App\Models\WorkoutSet;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);

        User::factory()->admin()->create([
            'name' => 'Admin 2',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        $users = User::factory(5)->create()->push($admin);
        $exercises = Exercise::factory(15)->create();

        foreach ($users as $user) {
            $workouts = Workout::factory(4)->for($user)->create();

            foreach ($workouts as $workout) {
                foreach ($exercises->random(2) as $exercise) {
                    WorkoutSet::factory(3)->for($workout)->for($exercise)->create();
                }
            }
        }
    }
}