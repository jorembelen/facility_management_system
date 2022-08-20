<?php

namespace App\View\Components;

use App\Models\Building;
use Illuminate\View\Component;

class UpgradedCheckout extends Component
{
    public $upgTotal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($upgTotal)
    {
        $this->upgTotal = count(Building::whereupgraded(1)->get());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.upgraded-checkout');
    }
}
