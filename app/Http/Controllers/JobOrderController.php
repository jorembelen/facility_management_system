<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Building;
use App\Models\Employee;
use App\Models\JobOrder;
use App\Models\Occupancy;
use Illuminate\Http\Request;
use App\Models\ClientAppointment;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\JobOrderStoreRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\ClosedRestorationRequest;
use App\Models\JobOrderTechnician;
use App\Notifications\ClosedAppointmentNotification;
use Illuminate\Support\Facades\Storage;

class JobOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobOrders = JobOrder::latest()->get();

        return view('job-orders.index', compact('jobOrders'));
    }

    public function closeRestoration(ClosedRestorationRequest $request)
    {
        //  return $request->all();
         $id = $request->id;

         $image = auth()->id();
         $admin = User::where('role', 'scheduler')
         ->get();

         $url = route('client-appointments.show', $id);

         $closedDetails = [
             'body' => 'Job Order No. ' .$id .' is completed and is closed.',
             'url' => $url,
             'sender' => $image,
         ];

         if($request->hasfile('closing_attachment')){
             $doc = $request->file('closing_attachment');


            // get the name of the file
            $name = $doc->hashName();
            $path = 'uploads/documents/';
            Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            $all_data['documents'] = $name;
         }

         $updateStatus = ClientAppointment::whereid($id)->update(array('status' => 1, 'closing_attachment' => $name));

        // Update Facilities Status
        $building = Building::whereid($request->building_id)
        ->update(array('status' => 0));

         Notification::send($admin, new ClosedAppointmentNotification($closedDetails));
         Alert::toast('Appointment ' .$id .' was successfully closed!', 'success');

         return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobOrderStoreRequest $request)
    {
        $data = new JobOrder();
        $data->user_id = $request->user_id;
        $data->client_appointment_id = $request->client_appointment_id;
        if($request->filled('new_date')){
            $data->date = $request->new_date;
        }else{
            $data->date = $request->date;
        }
        if($request->filled('new_time')){
            $data->time = $request->new_time;
        }else{
            $data->time = $request->time;
        }
        $data->notes = $request->notes;
        $data->technicians = implode(',', $request->technicians);
        $data->save();

        Alert::toast('New Schedule was successfully created!', 'success');

        return back();
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd('cancelled');
        $jobOrder = ClientAppointment::findOrFail($id);
        $employees = Employee::latest()->get();
        $schedules = jobOrder::whereclient_appointment_id($id)->get();

        return view('appointments.index', compact('jobOrder', 'employees', 'schedules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(JobOrder $jobOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOrder $jobOrder)
    {
        $data = $request->all();
        if($request->technicians){
            $data['technicians'] = implode(',', $request->technicians);
            // dd($data);
        }
            $jobOrder->update($data);
            Alert::toast('Appointment was successfully updated!', 'success');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobOrder  $jobOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOrder $jobOrder)
    {
        $jobOrder->delete();
        Alert::success('Success', 'Appointment was deleted successfully.');
        return back();
    }
}
