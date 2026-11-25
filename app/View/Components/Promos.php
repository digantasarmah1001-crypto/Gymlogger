<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use Illuminate\View\Component;

class Promos extends Component
{
    public array $promos;

    public function __construct()
    {
        // Two different promos: the first goes left, the second goes right.
        $this->promos = Arr::random(config('promos'), 2);
    }

    public function render(): View
    {
        return view('components.promos');
    }
}
