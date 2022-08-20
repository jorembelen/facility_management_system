<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Schedule;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\ClientAppointmentRequest;
use App\Http\Requests\SchedulerGetAppointmentRequest;
use Illuminate\Support\Facades\DB;

class SchedulerController extends Controller
{
    public function create()
    {
        $categories = WorkCategory::all();
        $tenants = User::whererole('tenant')->get();
        return view('scheduler.get_schedule', compact('categories', 'tenants'));
    }

    public function prevMaint()
    {
        session()->put('previousRoute', url()->previous());
        $appointments = ClientAppointment::with('building')
        ->wherework_category_id(11)
        ->wherestatus(0)
        ->latest()
        ->get();

        return view('scheduler.openIndex', compact('appointments'));
    }


    public function searchSchedule(SchedulerGetAppointmentRequest $request)
    {
        // return $request->all();
        $tenant = User::whereid($request->tenant_id)->wherehas('occupancy')->firstOrFail();
        $tenantType = $tenant->building->type->id;

        $options = CategoryOption::wherework_category_id($request->category)->get();
        $locations = MaintenanceLocation::wherefacility_type_id($tenantType)->get();

        $today = Carbon::today();
        $dateAllowed = $today->addDays(-1);

        $schedules = Schedule::wherework_category_id($request->category)
        ->where('date', $request->date)
        ->get();

        if($schedules->count() == 0){
            Alert::error('Failed', 'Sorry, No available schedule on selected date!');
            return back();
        }
        if($request->date <= $dateAllowed)
        {
            Alert::error('Failed', 'Sorry, You cannot book appointment later than today!');
            return back()->withInput();
        }else{
            $date = $request->date;
            $category = WorkCategory::whereid($request->category)->firstOrFail();
        }

      return view('scheduler.create', compact('schedules', 'date', 'category', 'category', 'options', 'locations', 'tenant'));
    }

    public function storePM(Request $request)
    {
        // return $request->all();

        $data = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $data->createPreventiveMaintenance($request);

            DB::commit();
            Alert::success('Success', 'Appointment was successfully created!.');

        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
        }

       return redirect(route('prevMaint'));

    }


    public function store(Request $request)
    {
        $data = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $data->createAppointment($request);

            DB::commit();
            Alert::success('Success', 'Appointment was successfully created!.');

        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
        }

        return redirect()->route('appointments.open');
    }


}
