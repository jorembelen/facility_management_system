<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\MaintenanceLocationImport;

class MaintenanceLocationController extends Controller
{
    public function importIndex()
    {
        return view('maintenance-location.import');
    }

    public function import(Request $request)
    {
        $validator = Excel::import(new MaintenanceLocationImport,request()->file('file'));
        
        Alert::success('Success', 'Maintenance Location Imported Successfully!');
           
        return back();
    }
}
