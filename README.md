# Gymlogger

A simple workout tracker built with Laravel for CS404 (Modern Web Application 1).

You log a workout (for example "Leg day"), add your sets to it (exercise, reps, weight)
and see your best lift for every exercise. You can also save your favourite exercises.

## Install

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Open http://localhost:8000

Admin login: `admin@example.com` / `password` (`admin@admin.com` / `password` also works)

## Data model

- User 1-N Workout: a user has many workouts.
- Workout 1-N WorkoutSet: a workout has many sets.
- Exercise 1-N WorkoutSet: an exercise has many sets, a set has one exercise.
- User N-M Exercise: a user has many favourite exercises (pivot table `exercise_user`).

## Who can do what

- Guests can see the welcome page, the exercises and the photo credits, and can register.
- Logged-in users can log their own workouts and sets, and save favourite exercises. Nobody else can see their workouts.
- The admin can add, edit and delete exercises (with a photo upload), and can see all workouts.

## Features

- Full CRUD for exercises, workouts and sets, with validation and custom error messages.
- Photo upload for exercises (saved in `public/uploads/exercises`), with a fallback image.
- The welcome page is cached and the cache is cleared when exercises, workouts or sets change.
- The menu is a View component (`app/View/Components/Menu.php`), shown in the header and the footer.
- Relationships are eager loaded with only the needed columns (no N+1 queries).

## Photos

The exercise photos are free to use (CC0, public domain, CC BY, CC BY-SA). See the Photo credits page in the app.