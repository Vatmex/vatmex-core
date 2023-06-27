<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Phonetic extends Component
{
    protected $dictionary;

    public $random;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $dictionary = ['Alpha', 'Bravo', 'Charlie', 'Delta', 'Echo', 'Foxtrot', 'Golf', 'Hotel', 'India', 'Juliet', 'Kilo', 'Lima', 'Mike', 'November', 'Oscar', 'Papa', 'Quebec', 'Romeo', 'Sierra', 'Tango', 'Uniform', 'Victor', 'Whiskey', 'Xray', 'Yankee', 'Zulu'];

        $randomKey = array_rand($dictionary);
        $this->random = $dictionary[$randomKey];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.phonetic');
    }
}
