<?php

namespace App\Http\Livewire\Supervisor;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\Occupancy;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpgradeCheckout extends Component
{
    use WithFileUploads;
    public $buildingId, $checkout_date, $attachment, $userId;

    public function render()
    {
        $checkout = Building::whereupgraded(1)
        ->get();

        return view('livewire.supervisor.upgrade-checkout', compact('checkout'))->extends('layouts.master');
    }

    public function approveShow(User $user)
    {
        $this->dispatchBrowserEvent('show-reqCheckout-form');
        $this->buildingId = $user->building->id;
        $this->userId = $user->badge;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->resetInput();
        $this->resetValidation();
    }

    public function resetInput()
    {
        $this->checkout_date = null;
        $this->time = null;
        $this->attachment = null;
    }

    public function submit(Building $building)
    {
        $data = $this->validate([
            'checkout_date' => 'required',
            'attachment' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf',
        ]);
        $occupancy = Occupancy::wherebuilding_id($this->buildingId)->firstOrFail();

        if($building->appointments){
            foreach($building->appointments as $appointment){
                if($appointment->status == 0) {
                    $this->dispatchBrowserEvent('swal:modal', [
                        'type' => 'error',
                        'title' => 'Failed, This facility has pending appointment!',
                        'text' => '',
                    ]);
                    $this->dispatchBrowserEvent('hide-form');
                    return redirect()->route('appointment.info', $appointment->id);
                }
            }
        }

        if($this->checkout_date < $occupancy->checkin_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Failed, Checkout date should be greater than Checkin date!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            return back();
        }
        $tenant = User::find($this->userId);
        $data['tenant_id'] = $this->userId;
        $data['checkin_date'] = $occupancy->checkin_date;
        $data['building_id'] = $this->buildingId;
        $data['checkout_date'] = $this->checkout_date;
        // dd('here');
        DB::beginTransaction();
        if($occupancy) {
            $tenant->checkoutTenant($data);
            $tenant->update(array('upgraded' => 0));
            // Update User Role
            ApplicationLog::create([
                'log_info' => $tenant->name .' was checkedout by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Tenant was successfully checked in.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->resetInput();
            return redirect('occupancies-assigned');
        }else{
            DB::rollBack();
        }

    }

}
