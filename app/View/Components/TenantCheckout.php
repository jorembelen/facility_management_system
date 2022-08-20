<?php

namespace App\View\Components;

use App\Models\Building;
use Illuminate\View\Component;

class TenantCheckout extends Component
{
    public $tenCheckout;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tenCheckout)
    {
          $this->tenCheckout = count(Building::wherestatus(3)->get());
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tenant-checkout');
    }
}
