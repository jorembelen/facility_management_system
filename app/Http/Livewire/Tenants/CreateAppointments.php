<?php

namespace App\Http\Livewire\Tenants;

use App\Models\ApplicationLog;
use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Models\Schedule;
use App\Models\User;
use App\Models\WorkCategory;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateAppointments extends Component
{
    use WithFileUploads;
    public $category, $date, $workCategory, $schedules, $options, $locations, $schedule_time, $iteration,
            $job_description, $documents, $other_description, $images, $catId, $categoryName, $categoryNameArabic;
    public $job_location = [];
    // public $images = [];
    public $selectScheduleShow = true;
    public $showHelp = false;
    public $hasImages = 0;
    public $hasDocs = 0;

    protected $messages = [
        'job_location.required' => 'Please select job location.',
        'schedule_time.required' => 'Please select appointment time.',
        'other_description.required_if' => 'Please provide other description.',
    ];

    public $listeners = [
        'classChanged'
     ];

     public function classChanged($value)
     {
         $this->job_location = $value;
     }

     public function mount()
     {
         session()->put('previousRoute', url()->previous());
     }

     public function render()
     {
         $categories = WorkCategory::whereNotIn('id', [11,12,13])
             ->get(['id', 'name', 'arabic']);

         return view('livewire.tenants.create-appointments', compact('categories'))->extends('layouts.master');
     }

    public function getSchedule()
    {
        if(auth()->user()->building->status == 3){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, You have pending request for checkout, Cancel first to proceed.',
                'text' => '',
            ]);
            return redirect()->back();
        }
        $data = $this->validate([
            'category' => 'required',
            'date' => 'required|after:tomorrow',
        ]);

        $sched = Schedule::wherework_category_id($this->category)
        ->where('date', $this->date)
        ->count();

        if($sched == 0){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, No available schedule on selected date! عذرا ، لا يوجد جدول متاح في التاريخ المحدد!',
                'text' => '',
            ]);
            return redirect()->back();
        }
        $this->workCategory = WorkCategory::whereid($this->category)->firstOrFail();
        $this->schedules = Schedule::wherework_category_id($this->category)
        ->where('date', $this->date)
        ->get();
        $this->options = CategoryOption::select('name', 'arabic')->wherework_category_id($this->category)->get();
        $this->locations = MaintenanceLocation::select('location', 'arabic')->wherework_category_id($this->category)->get();

        $this->selectScheduleShow = false;
        $this->catId = $this->category;
        $this->dispatchBrowserEvent('reApplySelect2');
    }


    public function createAppointment()
    {
        $data = $this->validate([
            'job_location' => 'required',
            'job_description' => 'required',
            'schedule_time' => 'required',
            'other_description' => 'required_if:job_description,Others',
            'images.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,jpg',
            'documents' => 'nullable|mimes:pdf',
        ]);

        $data['images'] = $this->images ?? null;
        $appointments = ClientAppointment::whereuser_id(auth()->id())
        ->where('date', $this->date)
        ->where('schedule_time', $this->schedule_time)
        ->where('work_category_id', $this->workCategory->id)
        ->get();

        if($appointments->count() > 0){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, You cannot book twice for the same appointment!',
                'text' => '',
            ]);
            return redirect()->back();
        }

        $data['hasImages'] = $this->images ? 1 : 0;
        $data['hasDocs'] = $this->documents ? 1 : 0;
        $data['user_id'] = auth()->id();
        $data['date'] = $this->date;
        $data['work_category_id'] = $this->workCategory->id;
        $data['building_id'] = auth()->user()->tenantActiveFacilityId();
        $data['catId'] = $this->catId;

        $appointment = new ClientAppointment();
        DB::beginTransaction();
        if($appointment) {
            // Transaction will be process on Apppointment Traits
            $appointment->addNewTenantAppointment($data);

            DB::commit();
            // Log the transaction
            ApplicationLog::create([
                'log_info' => 'New appointment was created by ' .auth()->user()->name,
            ]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Appointment was successfully created!.',
                'text' => '',
            ]);
            return redirect()->route('tenant.appointments', 0);
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    public function removeMe($index)
    {
        array_splice($this->images, $index, 1);
        $this->iteration++;
        $this->resetValidation();
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function help($category)
    {
        $this->validate([
            'category' => 'required'
        ]);

        $this->options = CategoryOption::wherework_category_id($this->category)->get(['name', 'arabic']);
        $this->workCategory = WorkCategory::find($this->category);
        $this->showHelp = true;
        $this->categoryName = $this->workCategory->name;
        $this->categoryNameArabic = $this->workCategory->arabic;
        $this->dispatchBrowserEvent('show-help-modal');
        $this->dispatchBrowserEvent('reApplySelect2');

    }


    public function close()
    {
        $this->dispatchBrowserEvent('hide-modal');
        $this->category = $this->category;
    }

    public function remove()
    {
        $this->iteration++;
        $this->documents = null;
        $this->resetValidation();
        $this->dispatchBrowserEvent('reApplySelect2');
    }


}
