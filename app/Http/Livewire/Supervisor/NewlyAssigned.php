<?php

namespace App\Http\Livewire\Supervisor;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class NewlyAssigned extends Component
{
    use WithFileUploads;
    public $tenantName, $checkin_date, $buildingId, $checkin_attachment, $iteration;
    public $table = true;

    public function render()
    {
        $occupancies = Building::with('occupancy')->wherestatus(1)->get();
        $total = count($occupancies);

        return view('livewire.supervisor.newly-assigned', compact('occupancies', 'total'));
    }

    public function checkIn(Building $building)
    {
        $this->dispatchBrowserEvent('show-assign-form');
        $this->tenantName = $building->tenant->name;
        $this->buildingId = $building->id;
        $this->table = true;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->checkin_date = null;
        $this->time = null;
        $this->checkin_attachment = null;
        $this->table = false;
        $this->iteration++;
        $this->resetValidation();
    }

    public function submit(Building $building)
    {
        $data = $this->validate([
            'checkin_date' => 'required',
            'checkin_attachment' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf|max:5120',
        ],[
            'checkin_attachment.max' => 'Please attach file not more than 5MB.',
        ]);

        if($this->checkin_date < $building->occupancy->assigned_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Failed, Checkin date should be greater than Assigned date!',
                'text' => '',
            ]);
            $this->close();
            return back();
        }

        $tenant = User::find($building->tenant_id);
        $b = Building::wheretenant_id($building->tenant_id)->wherestatus(2)->first();

        $data['tenant_id'] = $tenant->badge;
        $data['id'] = $building->id;
        $data['checkin_date'] = $this->checkin_date;
        $data['upgraded'] = $tenant->upgraded == 2 ? 3 : 0;
        // dd($data);
        DB::beginTransaction();
        if($tenant) {
            $tenant->checkinTenant($data);
            if($b){
                $b->update(['upgraded' => 1]);
            }
            ApplicationLog::create([
                'log_info' => $tenant->name .' was checkedin by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Tenant was successfully checked in.',
                'text' => '',
            ]);
            $this->close();
            return redirect('occupancies-assigned');
        }else{
            DB::rollBack();
        }
    }

}
