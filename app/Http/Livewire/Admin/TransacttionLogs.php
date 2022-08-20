<?php

namespace App\Http\Livewire\Admin;

use App\Models\ApplicationLog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TransacttionLogs extends Component
{
    public function render()
    {
        $logs = DB::table('application_logs')
            ->latest()
            ->get();

        // dd($logs);
        return view('livewire.admin.transacttion-logs', compact('logs'))->extends('layouts.master');
    }
}
