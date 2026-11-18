<?php
namespace Database\Factories;
use App\Models\Exercise;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
* @extends Factory<Exercise>
*/
class ExerciseFactory extends Factory
{
private const EXERCISES = [
'Bench Press' => ['Chest', 'Barbell'],
'Push-up' => ['Chest', 'Bodyweight'],
'Dumbbell Fly' => ['Chest', 'Dumbbells'],
'Deadlift' => ['Back', 'Barbell'],
'Pull-up' => ['Back', 'Bodyweight'],
'Barbell Row' => ['Back', 'Barbell'],
'Back Squat' => ['Legs', 'Barbell'],
'Leg Press' => ['Legs', 'Machine'],
'Lunge' => ['Legs', 'Dumbbells'],
'Overhead Press' => ['Shoulders', 'Barbell'],
'Lateral Raise' => ['Shoulders', 'Dumbbells'],
'Biceps Curl' => ['Arms', 'Dumbbells'],
'Triceps Pushdown' => ['Arms', 'Cable'],
'Plank' => ['Core', 'Bodyweight'],
'Cable Crunch' => ['Core', 'Cable'],
];
public function definition(): array
{
$name = fake()->unique()->randomElement(array_keys(self::EXERCISES));
[$muscleGroup, $equipment] = self::EXERCISES[$name];
return [
'name' => $name,
'muscle_group' => $muscleGroup,
'equipment' => $equipment,
'description' => fake()->sentence(10),
];
}
}