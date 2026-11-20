<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use App\Models\Workout;
use App\Models\WorkoutSet;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $data = Cache::remember('welcome', now()->addHour(), fn () => [
            'exerciseCount' => Exercise::where('is_approved', true)->count(),
            'workoutCount' => Workout::count(),
            'setCount' => WorkoutSet::count(),
            'exercises' => Exercise::where('is_approved', true)->orderBy('name')->take(8)->get()->toArray(),
        ]);

        $data['exercises'] = Exercise::hydrate($data['exercises']);

        return view('welcome', $data);
    }

    public function credits()
    {
        $photos = [
            ['Welcome page', 'Humphrey Muleba', 'CC0', 'https://stocksnap.io/photo/gym-interior-LNCLN1NE6K'],
            ['Bench Press', 'A. Blight', 'CC BY 2.0', 'https://www.flickr.com/photos/14040488@N02/4411752843'],
            ['Push-up', 'U.S. Army Europe', 'Public Domain', 'https://www.flickr.com/photos/37585279@N03/9554829150'],
            ['Dumbbell Fly', 'Everkinetic', 'CC BY-SA 3.0', 'https://commons.wikimedia.org/w/index.php?curid=11936650'],
            ['Deadlift', 'adrian valenzuela', 'CC BY 2.0', 'https://www.flickr.com/photos/86867910@N00/8707529607'],
            ['Pull-up', 'nenadstojkovicart', 'CC BY 2.0', 'https://www.flickr.com/photos/202846129@N03/54581910078'],
            ['Barbell Row', 'personaltrainertoronto', 'CC BY 2.0', 'https://www.flickr.com/photos/121183998@N08/43839328821'],
            ['Back Squat', 'personaltrainertoronto', 'CC BY 2.0', 'https://www.flickr.com/photos/121183998@N08/43892798441'],
            ['Leg Press', 'ORTUS FITNESS', 'CC BY 2.0', 'https://www.flickr.com/photos/58504556@N07/44246985224'],
            ['Lunge', 'PTPioneer', 'CC BY 2.0', 'https://www.flickr.com/photos/182613284@N02/48441902027'],
            ['Overhead Press', 'PTPioneer', 'CC BY 2.0', 'https://www.flickr.com/photos/182613284@N02/48441692261'],
            ['Lateral Raise', 'Everkinetic', 'CC BY-SA 3.0', 'https://commons.wikimedia.org/w/index.php?curid=11936699'],
            ['Biceps Curl', 'PTPioneer', 'CC BY 2.0', 'https://www.flickr.com/photos/182613284@N02/48833746008'],
            ['Triceps Pushdown', 'personaltrainertoronto', 'CC BY 2.0', 'https://www.flickr.com/photos/121183998@N08/42257978440'],
            ['Plank', 'nenadstojkovicart', 'CC BY 2.0', 'https://www.flickr.com/photos/202846129@N03/54567600352'],
            ['Sit-up', 'PTPioneer', 'CC BY 2.0', 'https://www.flickr.com/photos/182613284@N02/48441889272'],
        ];

        return view('credits', ['photos' => $photos]);
    }
}