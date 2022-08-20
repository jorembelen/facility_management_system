<?php

namespace App\Http\Livewire\Scheduler;

use App\Models\Building;
use App\Models\ClientAppointment;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Restoration extends Component
{
    use WithFileUploads;
    public $building_id, $date, $time_start, $time_end, $job_description, $images, $documents;

    public function mount()
    {
        session()->put('previousRoute', url()->previous());
        $facilities = Building::wherestatus(4)->count();
        if($facilities == 0){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Failed, No facilities for restoration is available!.',
                'text' => '',
            ]);
            session()->flash('error', 'Sorry, No facilities for restoration is available!');
            return redirect()->route('restoration.list');
        }
    }

    public function render()
    {
        $facilities = Building::wherestatus(4)->get();

        return view('livewire.scheduler.restoration', compact('facilities'))->extends('layouts.master');
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
                'building_id' => 'required',
                'job_description' => 'required',
                'date' => 'required|after:today',
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i|after:time_start',
                'images.*' => 'nullable|mimes:jpeg,bmp,png,gif,svg,jpg',
                'documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf',
            ]);

        $data['images'] = $this->images ?? null;
        $data['work_category_id'] = 13;
        $data['scheduler_id'] = auth()->id();
        $data['user_id'] = auth()->id();
        // dd($data);
        $appointment = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $appointment->addNewRestoration($data);

            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Success, Appointment was successfully created!.',
                'text' => '',
            ]);
            return redirect(route('restoration.list'));
        }else{
            DB::rollBack();
        }
    }

}
