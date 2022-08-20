<?php

namespace App\Http\Livewire\Scheduler;

use App\Models\Building;
use App\Models\ClientAppointment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class PreventiveMaintenance extends Component
{
    use WithFileUploads;
    public  $locations, $date, $time_start, $time_end, $job_description, $documents,
            $images, $job_location, $building_id, $selectedCategories;


    protected $messages = [
        'building_id.required' => 'Please select building.',
        'date.after' => 'The date must not later than today.',
        'time_start.after' => 'The time start must not greater than time_end.',
        'time_end.after' => 'The time end must not later than time_start.',
    ];

    public function mount()
    {
        session()->put('previousRoute', url()->previous());
        $this->selectedCategories = $this->selectedCategories;
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function render()
    {
        // $facilities = Building::whereNotIn('facility_type_id', [9,10])->get();
        if($this->selectedCategories == 10){
            $facilityTypeId = [1,2,3,4,5,6,7,8];
        }elseif($this->selectedCategories == 9){
            $facilityTypeId = [9,10,11];
        }else{
            $facilityTypeId = null;
        }
        $this->dispatchBrowserEvent('reApplySelect2');

        return view('livewire.scheduler.preventive-maintenance', compact('facilityTypeId'));
    }

    public $listeners = [
        'classChanged'
    ];

    public function classChanged($value)
    {
        $this->building_id = $value;
    }


    public function submit()
    {
            $data = $this->validate([
                'selectedCategories' => 'required',
                'date' => 'required|after:yesterday',
                'building_id' => 'required',
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i|after:time_start',
                'job_description' => 'required',
                'job_location' => 'required',
                'images.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,jpg',
                'documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf',
            ]);

        $data['images'] = $this->images ?? null;
        $data['work_category_id'] = 11;
        $data['scheduler_id'] = auth()->id();
        $data['user_id'] = auth()->id();

        $appointment = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $appointment->addNewPreventiveMaintenance($data);

            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Appointment was successfully created!.',
                'text' => '',
            ]);
            return redirect(route('prevMaint'));
            $this->dispatchBrowserEvent('reApplySelect2');
        }else{
            DB::rollBack();
        }
    }

}
