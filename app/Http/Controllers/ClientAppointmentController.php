<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Chat;
use App\Models\User;
use App\Models\Building;
use App\Models\Schedule;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use App\Models\CategoryOption;
use App\Models\ClientAppointment;
use App\Models\MaintenanceLocation;
use App\Http\Requests\SurveyRequest;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\CancelAppointmentRequest;
use App\Http\Requests\ClientAppointmentRequest;
use App\Http\Requests\ClientGetAppointmentRequest;
use App\Notifications\TenantCheckoutRequestNotification;
use Illuminate\Support\Facades\DB;

class ClientAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $status = Building::wheretenant_id(auth()->id())->wherestatus(4)->first();
        $tenantFacilityId = auth()->user()->tenantActiveFacilityId();
        $appointments = ClientAppointment::wherebuilding_id($tenantFacilityId)
            ->latest()
            ->get();

        return view('clients.index', compact('appointments', 'status'));
    }

    public function tenantAppointments($var)
    {
        $tenantFacilityId = auth()->user()->tenantActiveFacilityId();
        if($var === '3'){
            $appointments = ClientAppointment::wherebuilding_id($tenantFacilityId)
            ->latest()
            ->get();
        }else{
            $appointments = ClientAppointment::wherebuilding_id($tenantFacilityId)
            ->wherestatus($var)
            ->latest()
            ->get();
        }

        return view('clients.index', compact('appointments', 'var'));
    }

    public function showSurvey(ClientAppointment $appointment)
    {
        return view('surveys.view', compact('appointment'));
    }


    public function cancel(CancelAppointmentRequest $request, $id)
    {
        $today = Carbon::today();
        $dateAllowed = $today->addDays(1);
        $cancel = ClientAppointment::findOrFail($id);

        if($cancel->date <= $dateAllowed)
        {
            Alert::error('Failed', 'Sorry, You cannot cancel appointment within 24 hours period!');
            return back();
        }else{
            // Re updating the scheduled appointment slot
            $slots = Schedule::wherework_category_id($cancel->work_category_id)
            ->where('date', $cancel->date)
            ->where('time', $cancel->schedule_time)
            ->get();
            foreach($slots as $slot){
                $avail_slot = $slot->slot;
            }
            $new_slot = $avail_slot + 1;

            $updateSlot = Schedule::wherework_category_id($cancel->work_category_id)
            ->where('date', $cancel->date)
            ->where('time', $cancel->schedule_time)
            ->update(array('slot' => $new_slot));
            // End Schedule Update

            // Update Appointment Status
            $cancel->whereid($id)
            ->update(array(
                'status' => 2,
                'cancellation_reason' => $request->cancellation_reason,
                'cancellation_comments' => $request->cancellation_comments
                ));

            $admin = User::whererole('supervisor')
                ->orWhere('role', 'scheduler')
                ->get();
            $tenant = User::findOrFail(auth()->id());
            $image = auth()->id();
            $url = route('appointments.cancelled');
            $details = [
                'body' =>   $tenant->name .' cancelled the appointment request.',
                'url' =>    $url,
                'sender' => $image,
                ];
            Notification::send($admin, new TenantCheckoutRequestNotification($details));

            Alert::toast('Your appointment was successfully cancelled!', 'success');
            return redirect(route('client-appointments.index'));
        }

    }

    // Apply for Checkout

    public function reqCheckout(Request $request)
    {
        $appointment = ClientAppointment::whereuser_id($request->user_id)
            ->wherestatus(0)
            ->get();
        if(count($appointment) > 0){
            session()->flash('error', 'Sorry, You have a pending appointment, Please cancel it first to proceed on checkout.');
            return redirect()->back();
        }

        $admin = User::whererole('supervisor')
        ->orWhere('role', 'representative')
        ->get();


        $tenant = User::findOrFail($request->user_id);
        $image = auth()->id();

        $details = [
            'body' => $tenant->name .' request for Checkout.',
            'url' => route('checkout.request'),
            'sender' => $image,
            ];

        $Occupancy = Building::wheretenant_id($request->user_id)
        ->whereid($request->building_id)
        ->firstOrFail();

        $Occupancy->update(array('status' => 3));
        // Alert::toast('Your request for checkout was successfully sent!', 'success');
        session()->flash('success', 'Thank you. Your request for checkout was successfully sent!');
        Notification::send($admin, new TenantCheckoutRequestNotification($details));
        return back();

    }

    public function cancelCheckout(Request $request)
    {
        $admin = User::whererole('supervisor')
        ->orWhere('role', 'representative')
        ->get();

        $tenant = User::findOrFail($request->user_id);
        $image = auth()->id();

        $details = [
            'body' => $tenant->name .' cancelled the Checkout request.',
            'url' => '#',
            'sender' => $image,
            ];

        $Occupancy = Building::wheretenant_id($request->user_id)
        ->whereid($request->building_id)
        ->firstOrFail();

        $Occupancy->update(array('status' => 2));
        // Alert::toast('Your checkout request was cancelled successfully!', 'success');
        session()->flash('success', 'Thank you. Your checkout request was successfully cancelled!');
        Notification::send($admin, new TenantCheckoutRequestNotification($details));
        return back();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('clients.get_schedule');
    }

    public function searchSchedule(ClientGetAppointmentRequest $request)
    {
        if(auth()->user()->isTenant())
        {
            $tenant = User::find(auth()->id());
            $tenantType = $tenant->building->type->id;
        }else{
            $tenantType = null;
        }

        $options = CategoryOption::wherework_category_id($request->category)->get();
        $locations = MaintenanceLocation::wherefacility_type_id($tenantType)->get();
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
            $category = WorkCategory::whereid($request->category)->firstOrFail();

        }

      return view('clients.create', compact('schedules', 'date', 'category', 'options', 'locations'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientAppointmentRequest $request)
    {
        $appointments = ClientAppointment::whereuser_id($request->user_id)
        ->where('date', $request->date)
        ->where('schedule_time', $request->schedule_time)
        ->where('work_category_id', $request->work_category_id)
        ->get();

        if($appointments->count() > 0)
        {
            Alert::error('Error', 'You cannot book twice for the same appointment');
            return redirect()->back();

        }

        $data = new ClientAppointment();
        DB::beginTransaction();
        if($data) {
            $data->addTenantAppointment($request);

            DB::commit();
            Alert::success('Success', 'Appointment was successfully created!.');

        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
        }

       return redirect('client-appointments');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $chats = Chat::whereclient_appointment_id($id)->orderBy('created_at', 'asc')->get();
        // $appointment = ClientAppointment::findOrFail($id);
        // if(auth()->user()->role == 'tenant' && $appointment->user_id != auth()->id()) {
        //     Alert::warning('Warning', 'You are not allowed to view this record!');
        //     return back();
        // }

        // $photos = explode('|', $appointment->images);

        // $today = Carbon::today();
        // $dateAllowed = $today->addDays(1);

        // $jobOrders =   $appointment->jobOrder;
        // if(!$jobOrders) {
        //     $jobOrders = null;
        // }

        // return view('clients.view', compact('appointment', 'photos', 'dateAllowed', 'dateAllowed', 'chats', 'jobOrders'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = ClientAppointment::findOrFail($id);
        if(auth()->user()->role == 'tenant' && $appointment->user_id != auth()->id()) {
            Alert::warning('Failed', 'You are not allowed to view this record!');
            return back();
        }
        $schedules = Schedule::wherework_category_id($appointment->work_category_id)
        ->where('date', $appointment->date)
        ->get();
        $photos = explode('|', $appointment->images);

        $options = CategoryOption::wherework_category_id($appointment->work_category_id)->get();

        return view('clients.edit', compact('appointment', 'schedules', 'photos', 'options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SurveyRequest $request)
    {
        $survey = ClientAppointment::whereid($request->id)
        ->update(array(
            'survey_score' => $request->survey_score,
            'survey_comments' => $request->survey_comments,
            'survey_status' => 1,
        ));

        Alert::toast('Thank you for your feedback!', 'success');

        return redirect('client-appointments');
    }

    public function updateAppointment(Request $request, $id)
    {
        $appointment = ClientAppointment::findOrFail($id);
        $all_data = $request->all();

        $photos = explode('|', $appointment->images);

        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){

                    // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = public_path('storage/uploads/images/');
                $name = $file->hashName();
                $ImageUpload->save($originalPath .$name);

                // for saving thumnail image
                $thumbnailPath = public_path('storage/uploads/thumbnails/');
                $ImageUpload->resize(300,200);
                $ImageUpload = $ImageUpload->save($thumbnailPath .$name);

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);

                // Remove old images
                foreach($photos as $photo){
                    $path1 = public_path('storage/uploads/images/');
                    $path2 = public_path('storage/uploads/thumbnails/');
                    // Delete old image from file
                    if($appointment->images != '') {
                        \File::delete($path1 .$photo);
                        \File::delete($path2 .$photo);
                    }
                }

            }
        }

        if($request->hasfile('documents')){
         $doc = $request->file('documents');

         // get the name of the image
         $name = $doc->hashName();
         $doc->move(public_path('storage/uploads/documents'),$name);
         $all_data['documents'] = $name;

        // Delete old deocuments from file
        if($appointment->documents != '') {
            unlink(public_path('storage/uploads/documents/') . $appointment->documents);
        }
     }

        $appointment->update($all_data);


        Alert::toast('Appointment successfully updated.', 'success');

        return redirect('client-appointments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
