<?php

namespace App\Http\Livewire\Supervisor;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\BuildingRestoration;
use App\Models\Occupancy;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CheckoutRequest extends Component
{
    use WithFileUploads;
    public $buildingId, $checkout_date, $attachment, $userId;
    public $table = true;

    public function render()
    {
        $buildings = Building::query()
            ->wherestatus(3)
            ->whereupgraded(0)
            ->get();

        $total = $buildings->count();

        return view('livewire.supervisor.checkout-request', compact('buildings', 'total'));
    }

    public function approveShow(User $user)
    {
        $this->dispatchBrowserEvent('show-reqCheckout-form');
        $this->buildingId = $user->building->id;
        $this->userId = $user->badge;
        $this->table = true;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->resetInput();
        $this->resetValidation();
        $this->table = false;
    }

    public function resetInput()
    {
        $this->checkout_date = null;
        $this->time = null;
        $this->attachment = null;
    }

    public function submit()
    {
        $data = $this->validate([
            'checkout_date' => 'required',
            'attachment' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf|max:5120',
        ],[
            'attachment.max' => 'Please attach file not more than 5MB.',
        ]);
        $occupancy = Occupancy::wherebuilding_id($this->buildingId)->firstOrFail();

        if($this->checkout_date < $occupancy->checkin_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Failed, Checkout date should be greater than Checkin date!',
                'text' => '',
            ]);
            $this->close();
            return back();
        }
        $tenant = User::find($this->userId);
        $data['tenant_id'] = $this->userId;
        $data['checkin_date'] = $occupancy->checkin_date;
        $data['building_id'] = $this->buildingId;
        $data['checkout_date'] = $this->checkout_date;


        DB::beginTransaction();
        if($occupancy) {

            // Get the checkout date and add 20 days for the default availability of the building
            $checkoutDate = Carbon::create($this->checkout_date);
            $availabiltyDate = $checkoutDate->addDays(20)->format('Y-m-d');

            // Checkout tenant to Tenant Traits
            $tenant->checkoutTenant($data);

            // Update User Role from Tenant to Staff
            $tenant->update([
                'role' => 'staff',
                'reset' => 0,
            ]);

            // Add restoration data to table for availability of the unit after restoration
            BuildingRestoration::create([
                'building_id' => $this->buildingId,
                'availability_date' => $availabiltyDate,
            ]);

            // Create Log
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
            return redirect()->route('checkout.request');
        }else{
            DB::rollBack();
        }

    }

}
