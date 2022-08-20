<?php

namespace App\Http\Livewire\Assigner;

use App\Models\ApplicationLog;
use App\Models\Building;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class AssignedFacilities extends Component
{
    protected $listeners = ['cancel'];

    public function render()
    {
        $occupancies = Building::wherestatus(1)->get();
        $total = count($occupancies);

        return view('livewire.assigner.assigned-facilities', compact('occupancies', 'total'));
    }

    public function alertConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirmCancel', [
            'type' => 'warning',
            'message' => 'Are you sure?',
            'text' => 'Are you sure? Please confirm to proceed.',
            'id' => $id
        ]);
    }

    public function cancel(Building $occupant)
    {
        DB::beginTransaction();
        if($occupant) {
            ApplicationLog::create([
                'log_info' => $occupant->tenant->name .' assigned transaction was cancelled by ' .auth()->user()->name,
            ]);
            $occupant->update([
                'status' => 0,
                'tenant_id' => null
            ]);
            // Delete the old Image from the file
            if($occupant->occupancy->assign_attachment) {
                $path = 'uploads/documents/'  .$occupant->occupancy->assign_attachment;
                Storage::disk('s3')->delete(parse_url($path));
            }
            $occupant->occupancy->delete();

            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Tenant was successfully cancelled.',
                'text' => '',
            ]);
            return redirect()->route('assign-facilty.tenant');
        }else{
            DB::rollBack();
        }
    }

}
