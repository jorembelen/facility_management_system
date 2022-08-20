<?php

namespace App\Http\Livewire\Scheduler;

use App\Models\ApplicationLog;
use App\Models\ClientAppointment;
use App\Models\Employee;
use App\Models\JobOrder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class JobOrders extends Component
{
    use WithFileUploads;
    public $appId, $technicians, $date, $time_start, $time_end, $time, $notes, $new_date, $eTechnicians, $joId, $documents, $closing_attachment;

    protected $messages = [
        'date.after' => 'The date must not later than today.',
        'eTechnicians.required' => 'Please select employee.',
        'time_start.required_without' => 'Time start is required.',
        'time_end.required_without' => 'Time end is required.',
        'new_date.required_without' => 'Appointment date is required.',
        'time_end.after' => 'The time end must not later than time_start.',
        'new_date.after' => 'The date must not later than today.',
    ];

    public function mount($id)
    {
        session()->put('previousRoute', url()->previous());
        $this->appId = $id;
    }

    public function render()
    {
        $jobOrder = ClientAppointment::findOrFail($this->appId);
        $employees = Employee::latest()->get();
        $schedules = JobOrder::whereclient_appointment_id($this->appId)->get();

        return view('livewire.scheduler.job-orders', compact('jobOrder', 'employees', 'schedules'))->extends('layouts.master');
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-form');
        $this->resetInput();
        $this->resetValidation();
    }

    public function restorationShow(ClientAppointment $appointment)
    {
        $this->dispatchBrowserEvent('show-closeRestoration-form');
        $this->appId = $appointment->id;

    }

    public function submitCloseRestoration(ClientAppointment $appointment)
    {
        $data = $this->validate([
            'closing_attachment' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf',
        ]);

        $data['id'] = $appointment->id;
        $data['building_id'] = $appointment->building_id;

        DB::beginTransaction();
        if($appointment) {
            $appointment->closeRestoration($data);
            ApplicationLog::create([
                'log_info' => $appointment->id .' was closed by ' .auth()->user()->name,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => $appointment->id .' was successfully closed.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->resetInput();
            return redirect()->back();
        }else{
            DB::rollBack();
        }
    }

    public function create($appId)
    {
        $app = ClientAppointment::whereid($appId)->firstOrFail();
        $jo = JobOrder::whereclient_appointment_id($appId)->get();
        $this->dispatchBrowserEvent('show-createJo-form');
        $this->date = $jo->count() > 0 ? null : $app->date->format('M-d-Y');
        $this->time = $jo->count() > 0 ? null : $app->schedule_time;
        $this->appId = $app->id;
    }

    public function submit()
    {
        $data = $this->validate([
            'technicians' => 'required',
            'new_date' => 'nullable|required_without:date|after:yesterday',
            'time_start' => 'nullable|required_without:time',
            'time_end' => 'nullable|required_without:time|date_format:H:i|after:time_start',
            'notes' => 'nullable',
        ]);

        $jo = new JobOrder();

        DB::beginTransaction();
        if($data) {
            $data['user_id'] = auth()->id();
            $data['client_appointment_id'] = $this->appId;
            if($this->new_date){
                $data['date'] = $this->new_date;
            }else{
                $data['date'] = $this->date;
            }
            if($this->time){
                $data['time'] = $this->time;
            }else{
                $data['time'] = date('h:i ', strtotime($this->time_start)) .' - '. date('h:i A', strtotime($this->time_end));
            }
            $data['technicians'] = implode(',', $this->technicians);

            $jo->create($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'New Schedule was successfully created.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->resetInput();
        }else{
            DB::rollBack();
        }
    }

    public function resetInput()
    {
        $this->technicians = null;
        $this->eTechnicians = null;
        $this->date = null;
        $this->new_date = null;
        $this->time = null;
        $this->time_start = null;
        $this->time_end = null;
        $this->notes = null;
        $this->documents = null;
        $this->closing_attachment = null;
        $this->dispatchBrowserEvent('reApplySelect2');
    }

    public function edit(JobOrder $jobOrder)
    {
        $this->dispatchBrowserEvent('show-editJo-form');
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->eTechnicians = explode(',', $jobOrder->technicians);
        $this->date = $jobOrder->date->format('M-d-Y');
        $this->time = $jobOrder->time;
        $this->notes = $jobOrder->notes;
        $this->joId = $jobOrder->id;
    }

    public function closeJobOrder(ClientAppointment $appointment)
    {
        $this->dispatchBrowserEvent('show-closeJo-form');
        $this->appId = $appointment->id;
    }

    public function submitCloseJobOrder(ClientAppointment $appointment)
    {
        $this->dispatchBrowserEvent('show-closeJo-form');
        $data = $this->validate([
            'documents' => 'nullable|mimes:zip,doc,docx,xlsx,xls,pdf',
        ]);
        DB::beginTransaction();
        if($appointment) {
            $data['appointment_id'] = $appointment->id;
            // dd($data);
            $appointment->closeAppointment($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Appointment ' .$appointment->id .' was successfully closed.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->resetInput();
        }else{
            DB::rollBack();
        }
    }

    public function delete(JobOrder $jobOrder)
    {
        $this->dispatchBrowserEvent('show-deleteJo-form');
        $this->joId = $jobOrder->id;
    }

    public function remove(JobOrder $jobOrder)
    {
        $this->dispatchBrowserEvent('show-deleteJo-form');
        $jobOrder->delete();
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Data was successfully deleted.',
            'text' => '',
        ]);
        $this->dispatchBrowserEvent('hide-form');
    }

    public function update(JobOrder $jobOrder)
    {
        $data = $this->validate([
            'eTechnicians' => 'required',
            'date' => 'required|after:yesterday',
            'time' => 'required',
            'notes' => 'nullable',
        ]);

        DB::beginTransaction();
        if($jobOrder) {
            if($this->eTechnicians){
                $data['technicians'] = implode(',', $this->eTechnicians);
            }

            // dd($data);
            $jobOrder->update($data);
            DB::commit();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Data was successfully updated.',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('hide-form');
            $this->resetInput();
        }else{
            DB::rollBack();
        }
    }

}
