# Gymlogger – notes for AI coding tools

Gymlogger is my CS404 (Modern Web Application 1) project, built with Laravel.
A user logs workouts. A workout has sets, and every set is one exercise with reps and a weight.

## Data model
- User 1-N Workout (a user has many workouts)
- Workout 1-N WorkoutSet (a workout has many sets)
- Exercise 1-N WorkoutSet (an exercise has many sets, a set has one exercise)

## Rules for code in this project
- Keep code short, simple and easy to explain. No extra features.
- Validate input in the controller with `$request->validate()`.
- Every route goes to a controller method.
- Views extend `layouts/app.blade.php`.
- The admin is `admin@example.com` / `password`.
