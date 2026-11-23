<?php

// The promos shown on the left and right of every page (on wide screens).
// Two different ones are picked at random on every page load.
return [
    [
        'title' => 'Missing an exercise?',
        'text' => 'Add it yourself and use it straight away.',
        'button' => 'Add exercise',
        'route' => 'exercises.create',
        'image' => 'images/exercises/sit-up.jpg',
    ],
    [
        'title' => 'Leg day?',
        'text' => 'Log every set and beat your best lift.',
        'button' => 'Log a workout',
        'route' => 'workouts.create',
        'image' => 'images/exercises/leg-press.jpg',
    ],
    [
        'title' => 'Save your favourites',
        'text' => 'Keep the exercises you love one click away.',
        'button' => 'My favourites',
        'route' => 'favourites.index',
        'image' => 'images/exercises/lateral-raise.jpg',
    ],
    [
        'title' => 'Need ideas?',
        'text' => 'Exercises with photos for every muscle group.',
        'button' => 'Browse exercises',
        'route' => 'exercises.index',
        'image' => 'images/exercises/dumbbell-fly.jpg',
    ],
];