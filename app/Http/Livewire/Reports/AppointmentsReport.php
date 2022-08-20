<?php

namespace App\Http\Livewire\Reports;

use App\Models\ClientAppointment;
use App\Models\WorkCategory;
use Livewire\Component;

class AppointmentsReport extends Component
{
    public $category, $start_date, $end_date, $status, $appointments;
    public $result = false;

    public function render()
    {
        $categories = WorkCategory::query()->get();

        return view('livewire.reports.appointments-report', compact('categories'));
    }

    public function refresh()
    {
        $this->category = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->status = null;
        $this->appointments = null;
        $this->result = false;
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker']);
        $this->dispatchBrowserEvent('refreshDate', ['componentDate' => '#datepicker2']);
    }

    public function filter()
    {
        $this->validate([
            'start_date' => 'required',
            'end_date' => 'required_with:start_date',
        ],[
            'end_date.required_with' => 'End date is required.',
        ]);


        $appointments = new ClientAppointment();

        if($this->category) {
            $appointments =  $appointments->wherework_category_id($this->category);
        }

        if($this->status) {
            $status = $this->status == 3 ? 0 : $this->status;
            $appointments =  $appointments->wherestatus($status);
            // dd($appointments);
        }

        if($this->start_date) {
            $appointments = $appointments->where('date', '>=', $this->start_date);
        }

        if($this->end_date) {
            $appointments = $appointments->where('date', '<=', $this->end_date);
        }

        if($this->end_date < $this->start_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'End date should be greater than Start date!',
                'text' => '',
            ]);
            $this->dispatchBrowserEvent('reApplySelect2');
            return back();
        }

        $this->appointments = $appointments->latest()->get();
        // dd($this->appointments);
        $this->dispatchBrowserEvent('reApplySelect2');
        $this->result = true;
        $this->dispatchBrowserEvent('refreshComponent', ['componentName' => '#export-buttons']);
    }

}
