<?php

namespace App\Http\Livewire\Tenants;

use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditAppointments extends Component
{
    use WithFileUploads;
    public $buildingId, $job_location, $job_description, $other_description, $hasImages, $hasDocs,
    $appointment, $options, $locations, $photos, $documents, $oldImages, $removeImages, $removeDocument;
    public $images = [];

    public function mount($buildingId)
    {
        $this->buildingId = $buildingId;
        $this->appointment = ClientAppointment::findOrFail($this->buildingId);
        if(auth()->user()->role == 'tenant' && $this->appointment->user_id != auth()->id()) {
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'You are not allowed to view this record!',
                'text' => '',
            ]);
            return back();
        }
        $this->options = CategoryOption::wherework_category_id($this->appointment->work_category_id)->get();
        $this->locations = MaintenanceLocation::wherework_category_id($this->appointment->work_category_id)->get();
        $this->job_location = explode(', ', $this->appointment->job_location);
        $this->job_description = $this->appointment->job_description;
        $this->hasImages = $this->appointment->images;
        $this->hasDocs = $this->appointment->documents;
        $this->oldImages = explode('|', $this->appointment->images);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function render()
    {
        return view('livewire.tenants.edit-appointments')->extends('layouts.master');
    }

    public function updateAppointment(ClientAppointment $appointment)
    {
        $data = $this->validate([
            'job_description' => 'required',
            'job_location' => $appointment->work_category_id == 10 ? 'nullable' : 'required',
            'other_description' => 'sometimes|required_if:job_description,Others',
            'images.*' => 'image',
        ]);

        DB::beginTransaction();
        if($appointment) {
            if($this->images){
                $img = $this->validate(['images.*' => 'image']);
                $data['images'] = $img['images'];
                $data['imgUpdate'] = 1;
            }else{
                $data['imgUpdate'] = 0;
            }

            if($this->documents){
                $docs = $this->validate(['documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf']);
                $data['documents'] = $docs['documents'];
                $data['docsUpdate'] = 1;
            }else{
                $data['docsUpdate'] = 0;
            }

            $data['removeImages'] = $this->removeImages;
            $data['removeDocument'] = $this->removeDocument;
            $data['appointment_id'] = $appointment->id;
            $appointment->updateAppointment($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Your appointment was successfully updated!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');

            return redirect()->route('appointment.info', $appointment->id);
        }else{
            DB::rollBack();
        }
    }

    public function remove()
    {
        $this->documents = null;
        $this->resetValidation();
        $this->dispatchBrowserEvent('reApplySelect2');
    }

}
