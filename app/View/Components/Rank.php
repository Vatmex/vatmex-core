<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Rank extends Component
{
    protected $dictionary = ['OBS', 'S1', 'S2', 'S3', 'C1', 'C2', 'C3', 'I1', 'I2', 'I3', 'SUP'];

    public $translation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $rank)
    {
        $this->translation = $this->dictionary[$rank - 1];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rank');
    }
}
