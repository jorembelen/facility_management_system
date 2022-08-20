<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Building;
use App\Models\Employee;
use App\Models\JobOrder;
use App\Models\Occupant;
use App\Models\Schedule;
use App\Models\Appointment;
use App\Models\FacilityType;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Http\Requests\ClosedJobOrder;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\AppointmentStoreRequest;
use App\Http\Requests\ClientGetAppointmentRequest;
use App\Notifications\ClosedAppointmentNotification;
use App\Notifications\TenantClosedAppointmentNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AppointmentController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $appointments = ClientAppointment::whereNotIn('work_category_id',[11,13])
            ->latest()
            ->get();

        return view('admin.appointments.index', compact('appointments'));
    }

    public function appointmentsWithSurvey()
    {
        $appointments = ClientAppointment::wheresurvey_status(1)->get();

        return view('admin.appointments.surveys', compact('appointments'));
    }

    public function printJO($id)
    {
        $appointment = ClientAppointment::findOrFail($id);

        return view('reports.job-order', compact('appointment'));
    }

    public function searchSchedule(ClientGetAppointmentRequest $request)
    {
        if(auth()->user()->role == 'tenant')
        {
            $tenant = User::whereid(auth()->user()->id)->wherehas('occupancy')->first();
            $tenantType = $tenant->building->type->id;
        }else{
            $tenantType = null;
        }

        $options = CategoryOption::wherework_category_id($request->category)->get();
        $locations = MaintenanceLocation::wherefacility_type_id($tenantType)->get();
        $categories = WorkCategory::all();
        $today = Carbon::today();
        $dateAllowed = $today->addDays(1);

        $schedules = Schedule::wherework_category_id($request->category)
        ->where('date', $request->date)
        ->get();

        if($schedules->count() == 0){
            Alert::error('Failed', 'Sorry, No available schedule on selected date!');
            return back()->withInput();
        }
        if($request->date <= $dateAllowed)
        {
            Alert::error('Failed', 'Sorry, You cannot book appointment within 24 hours period!');
            return back()->withInput();
        }else{
            $date = $request->date;
            $categoryId = WorkCategory::whereid($request->category)->get();

            foreach($categoryId as $data)
            {
                $categoryName = $data->name;
                $category_id = $data->id;
            }
        }

        return view('clients.create', compact('categories', 'schedules', 'date', 'categoryName', 'category_id', 'options', 'locations'));
    }

    public function emergencyCreate()
    {

        return view('scheduler.emergency-livewire');
    }


    public function search(Request $request)
    {
        $b_id = $request->input('building_id', []);
        foreach($b_id as $d)
        {
            $buildingName = substr($d, 2);
        }

        $data = $request->all();
        return $buildingName;
        $facilities = Building::wherefacility_type_id($request->category_id)->get();
        $type = FacilityType::whereid($request->category_id)->first();

        return view('scheduler.emergency-building', compact('facilities', 'type'));
    }

    public function searchLocation(Request $request)
    {
        $facilities = Building::whereid($request->facility_id)->first();
        $locations = MaintenanceLocation::wherefacility_type_id($facilities->facility_type_id)->get();
        $type = FacilityType::whereid($facilities->facility_type_id)->first();

        return view('scheduler.emergency-location', compact('locations', 'type', 'facilities'));
    }

    public function emergencyStore(Request $request)
    {
        $data = new ClientAppointment();
        $all_data = $request->all();

        $building_id = User::findOrFail($request->user_id);

        $all_data['building_id'] = $building_id->building->id;

        $emAppointment = $data->create($all_data);
        Alert::toast('Your appointment was successfully cancelled!', 'success');

        return redirect('open-appointments');
    }

    public function closed()
    {
        $appointments = ClientAppointment::with('building', 'client')
        ->whereNotIn('work_category_id', [11,13])
        ->where('status', 1)
        ->latest()
        ->get();

        return view('admin.appointments.closedIndex', compact('appointments'));
    }

    public function open()
    {
        $appointments = ClientAppointment::with('building', 'client')
        ->whereNotIn('work_category_id', [11,13])
        ->where('status', 0)
        ->latest()
        ->get();

        return view('admin.appointments.openIndex', compact('appointments'));
    }


    public function cancelled()
    {
        $appointments = ClientAppointment::with('building', 'client')
        ->whereNotIn('work_category_id', [11,13])
        ->where('status', 2)
        ->latest()
        ->get();

        return view('admin.appointments.cancelledIndex', compact('appointments'));
    }

    public function allAppointments()
    {
        $appointments = ClientAppointment::whereNotIn('work_category_id', [11,13])
            ->latest()
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    public function calendar()
    {
        $appointments = ClientAppointment::wherestatus(0)->get();
        $today = date("Y-m-d");

        return view('appointments.calendar', compact('appointments', 'today'));
    }

    public function showAppointment($id)
    {
        $appointments = Appointment::wherejob_order_id($id)->get();
        $jobOrder = JobOrder::findOrFail($id);
        $status = $jobOrder->status;

        return view('appointments.index', compact('appointments', 'jobOrder', 'id', 'status'));
    }

    public function closedAppointment(ClosedJobOrder $request)
    {
        $id = $request->id;
        $tenant = ClientAppointment::whereid($id)->firstOrFail();
        $tenantId = $tenant->user_id;

        DB::beginTransaction();
        if($tenant){

            $image = auth()->id();
            $user = User::where('id', $tenantId )->get();
            $admin = User::where('role', 'scheduler')
            ->orWhere('role', 'supervisor')
            ->get();

            if($tenant->user_id) {
                $greetings = 'Dear ' .$tenant->client->name .',';
            }else{
                $greetings = 'Greetings, ';
            }
            $url = route('appointment.info', $id);
            $rate_url = route('surveys.show', $id);

            $closedDetails = [
                'greeting' => $greetings,
                'body' => 'Job Order No. ' .$id .' is completed and is closed.',
                'user_body' => 'Job Order No. ' .$id .' is completed and is closed. Please do not forget to rate our service. Thank you.',
                'rate' => 'Please rate us.',
                'actionText' => 'Click here to view details.',
                'url' => $url,
                'rate_url' => $rate_url,
                'sender' => $image,
            ];

            if($request->hasfile('closing_attachment')){
                $doc = $request->file('closing_attachment');

                // get the name of the image
                $name = $doc->hashName();
                $path = 'uploads/documents/';
                Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            }

            $updateStatus = ClientAppointment::whereid($id)->update(array('status' => 1, 'closing_attachment' => $name ?? null));

            Notification::send($admin, new ClosedAppointmentNotification($closedDetails));
            if($tenant->user_id) {
                Notification::send($user, new TenantClosedAppointmentNotification($closedDetails));
            }

            DB::commit();
            Alert::toast('Appointment ' .$id .' was successfully closed!', 'success');

            return back();
        }else{
            DB::rollBack();
            return redirect()->back();
        }

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
    public function store(AppointmentStoreRequest $request)
    {
        $id = $request->job_order_id;

        $appointment = Appointment::create($request->all());
        $updateStatus = JobOrder::whereid($id)->update(array('status' => 1));
        Alert::toast('New Appointment was successfully created!', 'success');

        return redirect('/job-orders');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $chats = Chat::whereclient_appointment_id($id)->get();
        $appointment = ClientAppointment::findOrFail($id);

        return view('admin.appointments.appointment_details', compact('appointment', 'chats'));
    }

    public function info($badge)
    {
        return   $appointment = Occupant::findOrFail($badge);
        $employees = Employee::all();

        return view('appointments.create', compact('appointment', 'id', 'employees'));
    }
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
