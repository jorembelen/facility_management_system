<?php

namespace App\View\Components;

use App\Models\Building;
use Illuminate\View\Component;

class Span extends Component
{
    public $assigned;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($assigned)
    {
        $this->assigned = count(Building::wherestatus(1)->get());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.span');
    }
}
