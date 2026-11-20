<?php

namespace App\View\Components;

use App\Models\Exercise;
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

        if (auth()->user()?->is_admin) {
            $waiting = Exercise::where('is_approved', false)->count();
            $this->links["Suggestions ($waiting)"] = route('suggestions.index');
        }
    }

    public function render(): View
    {
        return view('components.menu');
    }
}