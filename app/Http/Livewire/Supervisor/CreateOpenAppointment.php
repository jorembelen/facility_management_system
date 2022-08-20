<?php

namespace App\Http\Livewire\Supervisor;

use App\Models\Building;
use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Models\User;
use App\Models\WorkCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;


class CreateOpenAppointment extends Component
{
    use WithFileUploads;
    public $tenant_id, $category, $date, $workCategory, $schedules, $options, $locations, $job_description,
    $tenantName, $time_start, $time_end, $other_description, $images, $documents, $buildingId, $tenantId,
    $catId, $building_id, $buildingInfo;

    public $selectScheduleShow = true;
    public $job_location = [];

    public function mount()
    {
        session()->put('previousRoute', url()->previous());
    }

    public function render()
    {
        $categories = WorkCategory::whereNotIn('id', [11,13])
        ->get(['id', 'name']);
        $facilities = Building::query()
            ->get();

        // $categories = WorkCategory::whereNotIn('id', [11,13])
        // ->get(['id', 'name']);
        // $tenants = User::whererole('tenant')->get();

        return view('livewire.supervisor.create-open-appointment', compact('categories', 'facilities'))->extends('layouts.master');
    }

    public $listeners = [
        'classChanged',
    ];

    public function classChanged($value)
    {
        $this->job_location = $value;
    }

    public function getSchedule()
    {
        $this->validate([
            'building_id' => 'required',
            'category' => 'required',
            'date' => 'required',
        ],['tenant_id.required' => 'Please choose tenant.']);


        $this->workCategory = WorkCategory::whereid($this->category)->firstOrFail();
        $this->buildingInfo = Building::find($this->building_id);
        $this->buildingId = $this->building_id;
        $this->catId = $this->category;
        $this->tenantId = $this->buildingInfo->tenant->badge ?? null;

        $this->options = CategoryOption::wherework_category_id($this->category)->get(['name']);

        $this->locations = MaintenanceLocation::select('location')->distinct()->get();

        $this->selectScheduleShow = false;
        $this->dispatchBrowserEvent('reApplySelect2');
    }


    public function createAppointment()
    {
        $data = $this->validate([
            'job_location' => 'required',
            'job_description' => 'required',
            'time_start' => 'required|date_format:H:i',
            'time_end' => 'required|date_format:H:i|after:time_start',
            'other_description' => 'required_if:job_description,Others',
            'images.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,jpg',
            'documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf|max:5120',
        ],[
            'other_description.required_if' => 'Please provide other description.',
            'documents.max' => 'Please attach file not more than 5MB.',
        ]);

        $data['user_id'] = $this->tenantId;
        $data['images'] = $this->images ?? null;
        $data['scheduler_id'] = auth()->id();
        $data['date'] = $this->date;
        $data['work_category_id'] = $this->workCategory->id;
        $data['building_id'] = $this->buildingId;
        $data['catId'] = $this->catId;

        $appointment = new ClientAppointment();
        DB::beginTransaction();
        if($appointment) {
            // Add appointment to Appointment Traits
            $appointment->supervisorAddNewTenantAppointment($data);

            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Appointment was successfully created!.',
                'text' => '',
            ]);
            return redirect()->route('appointments.open');
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function removeMe($index)
    {
        array_splice($this->images, $index, 1);
        $this->dispatchBrowserEvent('reApplySelect2');
    }

}
