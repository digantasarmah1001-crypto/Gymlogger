<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Menu extends Component
{
    public array $links;

    public function __construct()
    {
        $this->links = [
            'Exercises' => route('exercises.index'),
        ];

        if (auth()->check()) {
            $this->links['My workouts'] = route('workouts.index');
            $this->links['Favourites'] = route('favourites.index');
        }
    }

    public function render(): View
    {
        return view('components.menu');
    }
}