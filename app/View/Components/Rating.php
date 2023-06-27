<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Rating extends Component
{
    protected $dictionary = ['Pésimo', 'Malo', 'Regular', 'Bueno', 'Excelente'];

    public $translation;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(int $rating)
    {
        $this->translation = $this->dictionary[$rating - 1];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.rating');
    }
}
