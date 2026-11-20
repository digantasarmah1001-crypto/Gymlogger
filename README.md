# Gymlogger

A simple workout tracker built with Laravel for CS404 (Modern Web Application 1).

You log a workout (for example "Leg day"), add your sets to it (exercise, reps, weight)
and see your best lift for every exercise.

## Install

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open http://localhost:8000

Admin login: `admin@example.com` / `password`

## Data model

- User 1-N Workout: a user has many workouts.
- Workout 1-N WorkoutSet: a workout has many sets.
- Exercise 1-N WorkoutSet: an exercise has many sets, a set has one exercise.

## Who can do what

- Guests can see the welcome page and the exercises, and can register.
- Logged-in users can log their own workouts and sets. Nobody else can see them.
- The admin can add, edit and delete exercises, and can see all workouts.