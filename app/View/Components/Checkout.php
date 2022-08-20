<?php

namespace App\View\Components;

use App\Models\Building;
use Illuminate\View\Component;

class Checkout extends Component
{
    public $total;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($total)
    {
        $this->total = count(Building::wherestatus(3)->whereupgraded(0)->get());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkout');
    }
}
