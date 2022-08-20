<?php

namespace App\Http\Livewire\Reports;

use App\Models\Checkout;
use App\Models\Occupancy;
use Livewire\Component;

class CheckoutReport extends Component
{
    public $start_date, $end_date, $checkout, $total;
    public $result = false;

    public function render()
    {
        return view('livewire.reports.checkout-report')->extends('layouts.master');
    }

    public function refresh()
    {
        $this->start_date = null;
        $this->end_date = null;
        $this->result = false;
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

        $checkout = new Checkout();

        if($this->start_date) {
            $checkout = $checkout->where('checkout_date', '>=', $this->start_date);
        }

        if($this->end_date) {
            $checkout = $checkout->where('checkout_date', '<=', $this->end_date);
        }

        if($this->end_date < $this->start_date){
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'End date should be greater than Start date!',
                'text' => '',
            ]);
            return back();
        }

        $this->checkout =  $checkout->wherehas('tenant')->latest()->get();
        $this->total = count($this->checkout);

        $this->dispatchBrowserEvent('refreshComponent', ['componentName' => '#export-buttons']);
        $this->result = true;
    }

}
