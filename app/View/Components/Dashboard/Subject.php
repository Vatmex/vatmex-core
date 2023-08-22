<?php

namespace App\View\Components\Dashboard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Component;

class Subject extends Component
{
    public $subject;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Model $subject = null)
    {
        $this->subject = $subject;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard.subject');
    }
}
