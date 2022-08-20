<?php

namespace App\Http\Livewire\Assigner;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AssignTenant extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $buildingId, $tenant, $assigned_date, $remarks, $facilityType, $query;
    protected $paginationTheme = 'bootstrap';
    public $listeners = [
        'classChanged'
    ];
    protected $queryString = ['query'];

    public function updated($property)
    {
        if ($property === 'query') {
            $this->resetPage();
        }
    }

    public function classChanged($value)
    {
        $this->tenant = $value;
    }

    public function render()
    {
        $buildings = Building::search($this->query)
            ->wherestatus(0)->paginate(10);
        $total = $buildings->count();
        $tenants = User::whereDoesntHave('building')
        ->whererole('staff')
        ->orWhere('upgraded', 1)
        ->get();

        return view('livewire.assigner.assign-tenant', compact('buildings', 'total', 'tenants'))->extends('layouts.master');
    }

    public function close()
    {
        $this->tenant = null;
        $this->assigned_date = null;
        $this->remarks = null;
        $this->dispatchBrowserEvent('hide-form');
         $this->dispatchBrowserEvent('reApplySelect2');
         $this->resetValidation();
    }

    public function assign(Building $building)
    {
        $this->buildingId = $building->id;
        $this->facilityType = $building->type->name;
        $this->dispatchBrowserEvent('show-form');
    }

    public function submit(Building $building)
    {
        $data = $this->validate([
            'tenant' => 'required',
            'assigned_date' => 'required',
            'remarks' => 'nullable',
        ]);

        DB::beginTransaction();
        if($building) {
            $data['assignedBy'] = auth()->id();
            $data['building_id'] = $building->id;
            $data['tenant_id'] = $this->tenant;
            $data['assigned_date'] = $this->assigned_date;

            $building->assignTenant($data);
            $tenant = User::find($this->tenant);
           if($tenant->upgraded == 1){
               $tenant->update(['upgraded' => 2]);
           }
            ApplicationLog::create([
                'log_info' => $tenant->name .' was assigned as tenant by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Tenant was successfully assigned.',
                'text' => '',
            ]);

            $this->close();
            return redirect()->route('facilities.assigned');
        }else{
            DB::rollBack();
        }
    }
}
