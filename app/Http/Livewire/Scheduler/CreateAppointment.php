<?php

namespace App\Http\Livewire\Scheduler;

use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Models\Schedule;
use App\Models\User;
use App\Models\WorkCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAppointment extends Component
{
    use WithFileUploads;
    public $tenant_id, $category, $date, $workCategory, $schedules, $options, $locations, $job_description,
    $tenantName, $schedule_time, $other_description, $images, $documents, $buildingId, $tenantId,
    $catId, $time_start, $time_end;

    public $selectScheduleShow = true;
    public $emergencyTime = false;
    public $job_location = [];

    public function mount()
    {
        session()->put('previousRoute', url()->previous());
    }

    public function render()
    {
        $categories = WorkCategory::whereNotIn('id', [11,13])
        ->get(['id', 'name']);
        $tenants = User::whererole('tenant')->get();

        return view('livewire.scheduler.create-appointment', compact('categories', 'tenants'))->extends('layouts.master');
    }

    public $listeners = [
        'classChanged'
    ];

    public function classChanged($value)
    {
        $this->job_location = $value;
    }

    public function getSchedule()
    {
        $this->validate([
            'tenant_id' => 'required',
            'category' => 'required',
            'date' => $this->category == 12 ? 'required' : 'required|after:today',
        ],
        [
            'tenant_id.required' => 'Please select tenant.'
            ]
        );


        $sched = Schedule::wherework_category_id($this->category)
        ->where('date', $this->date)
        ->count();
        if($this->category != 12){
            if($sched == 0){
                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'error',
                    'title' => 'Sorry, No available schedule on selected date!',
                    'text' => '',
                ]);
                $this->dispatchBrowserEvent('reApplySelect2');
                return redirect()->back();
            }
        }

        $this->workCategory = WorkCategory::whereid($this->category)->firstOrFail();
        $tenant = User::find($this->tenant_id);
        $this->options = CategoryOption::wherework_category_id($this->category)->get(['name']);
        if($this->category == 12){
            $this->locations = MaintenanceLocation::select('location')->distinct()->get();;
            $this->emergencyTime = true;
            $this->job_description = 'Others';
        }else{
            $this->locations = MaintenanceLocation::wherework_category_id($this->category)->get();
            $this->schedules = Schedule::wherework_category_id($this->category)
            ->where('date', $this->date)
            ->get();
            $this->emergencyTime = false;
        }

        $this->tenantName = $tenant->name;

        $this->dispatchBrowserEvent('reApplySelect2');
        $this->buildingId = $tenant->building->id;
        $this->tenantId = $tenant->badge;
        $this->catId = $this->category;
        $this->selectScheduleShow = false;
    }


    public function createAppointment()
    {
        $data = $this->validate([
            'job_location' => 'required',
            'job_description' => 'required',
            'schedule_time' => $this->emergencyTime == false ? 'required': '',
            'time_start' => $this->emergencyTime == true ? 'required|date_format:H:i': '',
            'time_end' => $this->emergencyTime == true ? 'required|date_format:H:i|after:time_start' : '',
            'other_description' => 'required_if:job_description,Others',
            'images.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,jpg',
            'documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf|max:5120',
        ],[
            'other_description.required_if' => 'Please provide other description.',
            'documents.max' => 'Please attach file not more than 5MB.',
        ]);

        $data['images'] = $this->images ?? null;
        $appointments = ClientAppointment::whereuser_id($this->tenantId)
        ->where('date', $this->date)
        ->where('schedule_time', $this->schedule_time)
        ->where('work_category_id', $this->workCategory->id)
        ->get();

        if($appointments->count() > 0 && $this->catId != 9){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, You cannot book twice for the same appointment!',
                'text' => '',
            ]);
            return redirect()->back();
        }


        $data['user_id'] = $this->tenantId;
        $data['scheduler_id'] = auth()->id();
        $data['date'] = $this->date;
        $data['work_category_id'] = $this->workCategory->id;
        $data['building_id'] = $this->buildingId;
        $data['catId'] = $this->catId;

        $appointment = new ClientAppointment();
        DB::beginTransaction();
        if($appointment) {
            $appointment->addNewTenantAppointment($data);

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
