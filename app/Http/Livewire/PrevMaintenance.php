<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Building;
use App\Models\FacilityType;
use App\Models\MaintenanceLocation;

class PrevMaintenance extends Component
{
    public $facilities;
    public $locations;

    public $selectedCategories = null;
    public $selectedBuilding = null;
    public $selectedLocation = null;

    public function mount()
    {
        $this->facilities = collect();
        $this->locations = collect();
    }

    public function render()
    {
        return view('livewire.prev-maintenance');
    }

    public function updatedselectedCategories($selectedCategories)
    {
        $this->facilities = Building::wherefacility_type_id($selectedCategories)->get();
        $this->selectedBuilding = NULL;
    }

    // public function updatedselectedBuilding($data)
    // {
    //     if (!is_null($data)) {
    //         $this->locations = MaintenanceLocation::wherefacility_type_id($data)->get();
    //     }
    // }

}
