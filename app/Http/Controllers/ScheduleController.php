<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Schedule;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use App\Imports\ScheduleImport;
use App\Models\ClientAppointment;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\RestorationStoreRequest;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $schedules = new Schedule();
        $categories = WorkCategory::all();


        if($request->work_category_id) {
            $category = WorkCategory::findOrFail($request->work_category_id);
            $categoriesName = $category->name;
            $schedules =  $schedules->wherework_category_id($request->work_category_id);
        }else{
            $categoriesName = '';
        }

        if($request->start_date) {
            $schedules = $schedules->where('date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $schedules = $schedules->where('date', '<=', $request->end_date);
        }

        if($request->end_date < $request->start_date){
            Alert::error('Error', 'End date should be greater than Start date!');
        }


        $schedules = $schedules->orderBy('date', 'asc')->get();

        return view('schedules.index', compact('schedules', 'categories', 'categoriesName'));
    }

    public function importIndex()
    {
        return view('schedules.import');
    }

    public function monitoring(Request $request)
    {
        $schedules = new Schedule();
        $categories = WorkCategory::all();


        if($request->work_category_id) {
            $category = WorkCategory::findOrFail($request->work_category_id);
            $categoriesName = $category->name;
            $schedules =  $schedules->wherework_category_id($request->work_category_id);
        }else{
            $categoriesName = '';
        }

        if($request->start_date) {
            $schedules = $schedules->where('date', $request->start_date);
        }


        $schedules = $schedules->orderBy('date', 'asc')->get();

        return view('schedules.schedule-monitoring', compact('schedules', 'categories', 'categoriesName'));
    }

    public function import()
    {
        Excel::import(new ScheduleImport,request()->file('file'));

        Alert::success('Success', 'New Schedule was imported successfully!');

        return redirect(route('schedules.index'));
    }

    public function createRestoration()
    {

        return view('scheduler.restoration');
    }

    public function restorationList()
    {
        $appointments = ClientAppointment::where('work_category_id', 13)->get();

        return view('scheduler.restoration-index', compact('appointments'));
    }

    public function storeRestoration(RestorationStoreRequest $request)
    {
        $data = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $data->createRestoration($request);

            DB::commit();
            Alert::success('Success', 'Transaction was successfully created!.');

        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
        }

        return redirect(route('restoration.list'));
    }


    public function removeSchedulesIndex(Request $request)
    {

        $schedules = new Schedule();

        if($request->start_date) {
            $schedules = $schedules->where('date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $schedules = $schedules->where('date', '<=', $request->end_date);
        }

        if($request->end_date < $request->start_date){
            Alert::error('Error', 'End date should be greater than Start date!');
        }

        $schedules = $schedules->orderBy('date', 'asc')->get();

        return view('maintenance.schedules.delete-schedules', compact('schedules'));
    }

    public function removeSchedules(Request $request)
    {

        $schedules = Schedule::where('date', '>=', $request->start_date)
        ->where('date', '<=', $request->end_date)
        ->delete();

        Alert::success('Success', 'Schedule from ' .date('M-d', strtotime($request->start_date)).' to ' .date('M-d-Y', strtotime($request->end_date)). ' was successfully deleted!');

        return back();
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Schedule $schedule)
    {
        // return $request->slot;
        DB::beginTransaction();
        if($schedule){
            $schedule->update(['slot' => $request->slot]);
            DB::commit();
            Alert::success('success', 'Slot was updated successfully.');
            return redirect()->back();
        }else{
            DB::rollBack();
            return redirect()->back();
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Schedule  $schedule
    * @return \Illuminate\Http\Response
    */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
