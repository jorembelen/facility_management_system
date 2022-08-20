<?php

namespace App\Http\Livewire\Facilities;

use App\Models\Building;
use App\Models\BuildingRestoration;
use Livewire\Component;

class UnderRestoration extends Component
{
    public $availability_date, $notes, $buildingId;

    public function render()
    {
        $buildings = Building::with('restoration')->wherestatus(4)->latest()->get();
        $total = count($buildings);

        return view('livewire.facilities.under-restoration', compact('buildings', 'total'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->availability_date = null;
        $this->notes = null;
    }

    public function showUpdate($buildingId)
    {
        $this->dispatchBrowserEvent('show-modal');
        $this->buildingId = $buildingId;
    }

    public function update()
    {
        $data = $this->validate([
            'availability_date' => 'required',
            'notes' => 'required'
        ]);

        $restoration = BuildingRestoration::wherebuilding_id($this->buildingId)->first();
        $data['update_count'] = 1;
        $restoration->update($data);
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Data was successfully updated.',
            'text' => '',
        ]);
        $this->close();
        return;

    }

}
