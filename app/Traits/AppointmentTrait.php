<?php

namespace App\Traits;

use App\Models\ApplicationLog;
use App\Models\Building;
use App\Models\User;
use App\Models\ClientAppointment;
use App\Models\Schedule;
use App\Models\UserChatView;
use App\Models\WorkCategory;
use RealRashid\SweetAlert\Facades\Alert;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AppointmentNotification;
use App\Notifications\ClosedAppointmentNotification;
use App\Notifications\Tenant\AppointmentNotification as TenantAppointmentNotification;
use App\Notifications\TenantCheckoutRequestNotification;
use App\Notifications\TenantClosedAppointmentNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

trait AppointmentTrait {

    public function getUnreadChat()
    {
        $chats = UserChatView::whereuser_id(auth()->id())->whereappointment_id($this->id)->where('read_at', NULL)->count();
        if($chats){
            return $chats;
        }
        return 0;
    }

    public function surveyScore()
    {
        $appointment = ClientAppointment::find($this->id);
        if($appointment->survey_status == 1){
            if($appointment->survey_score == 1){
                return 'Poor';
            }elseif($appointment->survey_score == 2){
                return 'Needs Improvement';
            }elseif($appointment->survey_score == 3){
                return 'Satisfactory';
            }elseif($appointment->survey_score == 4){
                return 'Very Good';
            }else{
                return 'Excellent';
            }
        }

    }

    public function createAppointment($request)
    {
        $data = new ClientAppointment();
        $all_data = $request->all();

        $building_id = User::findOrFail($request->user_id);

        $all_data['building_id'] = $building_id->building->id;

        $appointments = ClientAppointment::whereuser_id($request->user_id)
        ->where('date', $request->date)
        ->where('schedule_time', $request->schedule_time)
        ->where('work_category_id', $request->work_category_id)
        ->get();

        if($appointments->count() > 0)
        {
            Alert::error('Error', 'You cannot book twice for the same appointment');
            return back()->withInput();

        }else{

            $slots = Schedule::wherework_category_id($request->work_category_id)
            ->where('date', $request->date)
            ->where('time', $request->schedule_time)
            ->first();

            $new_slot = $slots->slot - 1;

            $images=array();
            if($files=$request->file('images')){
                foreach($files as $file){

                    // for saving original image
                    $ImageUpload = Image::make($file);
                    $originalPath = 'uploads/images/';
                    $name = $file->hashName();
                    $ImageUpload->stream();
                    Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                    // for saving thumnail image
                    $thumbnailPath = 'uploads/thumbnails/';
                    $ImageUpload->resize(300,200)->stream();
                    Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                    // for saving to database
                    $images[]=$name;
                    $all_data['images'] = implode("|",$images);
                }
            }

            if($request->hasfile('documents')){
                $doc = $request->file('documents');

                // get the name of the image
                $name = $doc->hashName();
                $path = 'uploads/documents/';
                Storage::disk('s3')->put($path .$name, file_get_contents($doc));
                $all_data['documents'] = $name;
            }

            if($request->job_description == 'Others'){

                $all_data['job_description'] = $request->other_description;
            }else{
                $all_data['job_description'] = $request->job_description;
            }

            $data->create($all_data);


            $product = Schedule::wherework_category_id($request->work_category_id)
            ->where('date', $request->date)
            ->where('time', $request->schedule_time)
            ->update(array('slot' => $new_slot));

            //    Mail::to($email)->send(new AdminAppointmentMail($data));

        }
    }

    public function createPreventiveMaintenance($request)
    {
        $data = new ClientAppointment();
        $all_data = $request->all();

        $building = Building::find($request->buildingId);

        $buildingName = $building->name;
        $buildingId = $building->id;

        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($request->hasfile('documents')){
            $doc = $request->file('documents');

            // get the name of the file
            $name = $doc->hashName();
            $path = 'uploads/documents/';
            Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            $all_data['documents'] = $name;
        }

        if($request->job_description == 'Others'){
            $all_data['job_description'] = $request->other_description;
        }else{
            $all_data['job_description'] = $request->job_description;
        }

        $start = $request->time_start;
        $end = $request->time_end;
        $time = $start .' - ' .date('h:i a', strtotime($end));

        $all_data['schedule_time'] = $time;
        $all_data['building_id'] = $buildingId;
        $all_data['user_id'] = null;
        $all_data['job_location'] = $buildingName .' : '.$request->job_location;

        $data->create($all_data);

        //   $email = User::where('role', ['scheduler', 'supervisor'])->get();
        //    Mail::to($email)->send(new AdminAppointmentMail($data));
    }


    public function createRestoration($request)
    {
        // $email = User::whererole('scheduler || supervisor')->get();

        $data = new ClientAppointment();
        $all_data = $request->validated();


        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($request->hasfile('documents')){
            $doc = $request->file('documents');

            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/';
            Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            $all_data['documents'] = $name;
        }

        $start = $request->time_start;
        $end = $request->time_end;
        $time = date('h:i A', strtotime($start)) .' - ' .date('h:i A', strtotime($end));

        $all_data['schedule_time'] = $time;

        $data->create($all_data);
    }

    public function addTenantAppointment($request)
    {
        $data = new ClientAppointment();
        $all_data = $request->all();

        $building_id = User::findOrFail(auth()->id());

        $all_data['building_id'] = $building_id->building->id;


        $slots = Schedule::wherework_category_id($request->work_category_id)
        ->where('date', $request->date)
        ->where('time', $request->schedule_time)
        ->get();

        foreach($slots as $slot)
        {
            $avail_slot = $slot->slot;
        }

        $new_slot = $avail_slot - 1;

        $images=array();
        if($files=$request->file('images')){
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($request->hasfile('documents')){
            $doc = $request->file('documents');

            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/';
            Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            $all_data['documents'] = $name;
        }

        if($request->job_description == 'Others'){
            $all_data['job_description'] = $request->other_description;
        }else{
            $all_data['job_description'] = $request->job_description;
        }

        if($request->filled('job_location')){
            $all_data['job_location'] = implode(', ' , $request->job_location);
        }


        $data->create($all_data);


        $product = Schedule::wherework_category_id($request->work_category_id)
        ->where('date', $request->date)
        ->where('time', $request->schedule_time)
        ->update(array('slot' => $new_slot));

        $image = auth()->id();
        $url = route('appointments.open');
        $admin = User::where('role', 'supervisor')
        ->orWhere('role', 'scheduler')
        ->get();

        // Notification for Admin
        $adminDetails = [
            'url' => $url,
            'sender' => $image,
            'notifyAdmin' => 'New appointment was created by ' .auth()->user()->name,
        ];

        Notification::send($admin, new AppointmentNotification($adminDetails));

    }

    public function addNewTenantAppointment($request)
    {

        $data = new ClientAppointment();
        $all_data = $request;

        // Checking the schedule table and deduct the booked slot
        if($all_data['catId'] != 12){
            $schedules = Schedule::wherework_category_id($all_data['work_category_id'])
            ->where('date', $all_data['date'])
            ->where('time', $all_data['schedule_time'])
            ->first();
            $new_slot = $schedules->decrement('slot');
        }else{
            $start = $all_data['time_start'];
            $end = $all_data['time_end'];
            $time = date('h:i ', strtotime($start)) .' - ' .date('h:i A', strtotime($end));

            $all_data['schedule_time'] = $time;
        }

        $images=array();
        if($all_data['hasImages'] === 1){
            $files = $all_data['images'];
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($all_data['hasDocs'] === 1){
            $doc = $all_data['documents'];
            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/'  .$name;
            Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
            $all_data['documents'] = $name;
        }

        if($all_data['job_description'] == 'Others'){
            $all_data['job_description'] = $all_data['other_description'];
        }else{
            $all_data['job_description'] = $all_data['job_description'];
        }

        $all_data['job_location'] = implode(', ' , $all_data['job_location']);

        $data->create($all_data);


        // Details for the notification of Schedulers and Supervisors
        $image = auth()->id();
        $url = route('appointments.open');
        $admin = User::where('role', 'supervisor')
        ->orWhere('role', 'scheduler')
        ->get();

        $adminDetails = [
            'url' => $url,
            'sender' => $image,
            'notifyAdmin' => 'New appointment was created by ' .auth()->user()->name,
        ];
        // End

        // Details for the email notification to tenant
        $tenant = User::find($request['user_id']);
        $category = WorkCategory::find($request['work_category_id']);
        $date = date('M-d-Y', strtotime($all_data['date']));
        $details = [
            'greetings' => 'Dear ' .$tenant->name .',',
            'body' => 'Your appointment was successfully submitted with the details below.',
            'category' => 'Work Category: ' .$category->name,
            'complain' => 'Complain: ' .$request['job_description'],
            'location' => 'Location: ' .$all_data['job_location'],
            'schedule' => 'Scheduled Date and Time: ' .$date .', ' .$request['schedule_time'],
        ];
        // End

        // It will send email notification to tenant for confimation
        Notification::send($tenant, new TenantAppointmentNotification($details));

        // It will send application notification to schedulers and supervisors
        Notification::send($admin, new AppointmentNotification($adminDetails));

    }

    public function supervisorAddNewTenantAppointment($request)
    {

        $data = new ClientAppointment();
        $all_data = $request;


        $images=array();
        if($files = $all_data['images']){
            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($all_data['documents']){
            $doc = $all_data['documents'];
            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/'  .$name;
            Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
            $all_data['documents'] = $name;
        }

        if($all_data['job_description'] == 'Others'){
            $all_data['job_description'] = $all_data['other_description'];
        }else{
            $all_data['job_description'] = $all_data['job_description'];
        }

        $all_data['job_location'] = implode(', ' , $all_data['job_location']);
        $start = $all_data['time_start'];
        $end = $all_data['time_end'];
        $time = date('h:i ', strtotime($start)) .'- ' .date('h:i A', strtotime($end));

        $all_data['schedule_time'] = $time;


        $data->create($all_data);
        ApplicationLog::create([
            'log_info' => 'New appointment was created by ' .auth()->user()->name,
        ]);

        $image = auth()->id();
        $url = route('appointments.open');
        $admin = User::where('role', 'supervisor')
        ->orWhere('role', 'scheduler')
        ->get();

        // Notification for Admin
        $adminDetails = [
            'url' => $url,
            'sender' => $image,
            'notifyAdmin' => 'New appointment was created by ' .auth()->user()->name,
        ];

        // Send notification email if theres an occupant for the building
        if($all_data['user_id'] !== null){
            // Details for the email notification to tenant
            $tenant = User::find($request['user_id']);
            $category = WorkCategory::find($request['work_category_id']);
            $date = date('M-d-Y', strtotime($all_data['date']));
            $details = [
                'greetings' => 'Dear ' .$tenant->name .',',
                'body' => 'Your appointment was successfully submitted with the details below.',
                'category' => 'Work Category: ' .$category->name,
                'complain' => 'Complain: ' .$request['job_description'],
                'location' => 'Location: ' .$all_data['job_location'],
                'schedule' => 'Scheduled Date and Time: ' .$date .', ' .$time,
            ];
            // End

            // It will send email notification to tenant for confimation
            Notification::send($tenant, new TenantAppointmentNotification($details));
        }
        // End

        Notification::send($admin, new AppointmentNotification($adminDetails));

    }

    public function addNewPreventiveMaintenance($request)
    {
        $data = new ClientAppointment();
        $all_data = $request;

        $building = Building::find($all_data['building_id']);

        $buildingName = $building->name;
        $buildingId = $building->id;

        $images=array();
        if($files = $all_data['images']){

            foreach($files as $file){

                // for saving original image
                $ImageUpload = Image::make($file);
                $originalPath = 'uploads/images/';
                $name = $file->hashName();
                $ImageUpload->stream();
                Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                // for saving thumnail image
                $thumbnailPath = 'uploads/thumbnails/';
                $ImageUpload->resize(300,200)->stream();
                Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                // for saving to database
                $images[]=$name;
                $all_data['images'] = implode("|",$images);
            }
        }

        if($all_data['documents']){
            $doc = $all_data['documents'];
            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/'  .$name;
            Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
            $all_data['documents'] = $name;
        }

        // if($all_data['job_description'] == 'Others'){
            //     $all_data['job_description'] = $all_data['other_description'];
            // }else{
                //     $all_data['job_description'] = $all_data['job_description'];
                // }

                $start = $all_data['time_start'];
                $end = $all_data['time_end'];
                $time = date('h:i ', strtotime($start)) .' - ' .date('h:i A', strtotime($end));

                $all_data['schedule_time'] = $time;
                $all_data['building_id'] = $buildingId;
                $all_data['user_id'] = null;
                // $all_data['selectedLocation'] = $buildingName .' : '.$all_data['selectedLocation'];


                $data->create($all_data);

                //   $email = User::where('role', ['scheduler', 'supervisor'])->get();
                //    Mail::to($email)->send(new AdminAppointmentMail($data));
            }

            public function addNewRestoration($request)
            {
                $data = new ClientAppointment();
                $all_data = $request;

                $images=array();
                if($files = $all_data['images']){
                    foreach($files as $file){

                        // for saving original image
                        $ImageUpload = Image::make($file);
                        $originalPath = 'uploads/images/';
                        $name = $file->hashName();
                        $ImageUpload->stream();
                        Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                        // for saving thumnail image
                        $thumbnailPath = 'uploads/thumbnails/';
                        $ImageUpload->resize(300,200)->stream();
                        Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                        // for saving to database
                        $images[]=$name;
                        $all_data['images'] = implode("|",$images);
                    }
                }

                if($all_data['documents']){
                    $doc = $all_data['documents'];
                    // get the name of the image
                    $name = $doc->hashName();
                    $path = 'uploads/documents/'  .$name;
                    Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
                    $all_data['documents'] = $name;
                }

                $start = $all_data['time_start'];
                $end = $all_data['time_end'];
                $time = date('h:i ', strtotime($start)) .' - ' .date('h:i A', strtotime($end));

                $all_data['schedule_time'] = $time;

                $data->create($all_data);

                //   $email = User::where('role', ['scheduler', 'supervisor'])->get();
                //    Mail::to($email)->send(new AdminAppointmentMail($data));
            }

            public function closeAppointment($request)
            {
                $id = $request['appointment_id'];
                $tenant = ClientAppointment::whereid($id)->first();
                $tenantId = $tenant->user_id;


                $image = auth()->id();
                $user = User::find($tenantId );
                $admin = User::where('role', 'scheduler')
                ->orWhere('role', 'supervisor')
                ->get();

                if($tenant->user_id) {
                    $greetings = 'Dear ' .$tenant->client->name .',';
                }else{
                    $greetings = 'Greetings, ';
                }
                $url = route('appointment.info', $id);
                $rate_url = route('survey', $id);

                $closedDetails = [
                    'greeting' => $greetings,
                    'body' => 'Job Order No. ' .$id .' is completed and is closed.',
                    'user_body' => 'Job Order No. ' .$id .' is completed and was closed. Please do not forget to rate our service. Thank you.',
                    'rate' => 'Please rate us.',
                    'actionText' => 'Click here to view details.',
                    'url' => $url,
                    'rate_url' => $rate_url,
                    'sender' => $image,
                ];

                if($request['documents']){
                    $doc = $request['documents'];
                    // get the name of the image
                    $name = $doc->hashName();
                    $path = 'uploads/documents/'  .$name;
                    Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
                    $request['documents'] = $name;
                }

                ClientAppointment::whereid($id)->update(array('status' => 1, 'closing_attachment' => $name ?? null));

                Notification::send($admin, new ClosedAppointmentNotification($closedDetails));
                if($tenant->user_id) {
                    Notification::send($user, new TenantClosedAppointmentNotification($closedDetails));
                }
            }

            public function cancelAppointment($request)
            {
                $id = $request['appointment_id'];
                $cancel = ClientAppointment::findOrFail($id);

                $schedule = Schedule::wherework_category_id($cancel->work_category_id)
                ->where('date', $cancel->date)
                ->where('time', $cancel->schedule_time)
                ->first();
                if($schedule){
                    $schedule->increment('slot');
                }


                // Update Appointment Status
                $cancel->whereid($id)
                ->update(array(
                    'status' => 2,
                    'cancellation_reason' => $request['cancellation_reason'],
                    'cancellation_comments' => $request['cancellation_comments']
                ));

                $admin = User::whererole('supervisor')
                ->orWhere('role', 'scheduler')
                ->get();
                $tenant = User::findOrFail(auth()->id());
                $image = auth()->id();
                $url = route('appointment.info', $id);
                $details = [
                    'body' =>   $tenant->name .' cancelled the appointment request.',
                    'url' =>    $url,
                    'sender' => $image,
                ];
                Notification::send($admin, new TenantCheckoutRequestNotification($details));
            }

            public function updateAppointment($request)
            {
                $appointment = ClientAppointment::findOrFail($request['appointment_id']);
                $all_data = $request;
                // dd($all_data);
                $photos = explode('|', $appointment->images);


                $images=array();
                if($all_data['imgUpdate'] === 1){
                    $files = $all_data['images'];

                    foreach($files as $file){

                        // for saving original image
                        $ImageUpload = Image::make($file);
                        $originalPath = 'uploads/images/';
                        $name = $file->hashName();
                        $ImageUpload->stream();
                        Storage::disk('s3')->put($originalPath .$name, $ImageUpload->__toString());

                        // for saving thumnail image
                        $thumbnailPath = 'uploads/thumbnails/';
                        $ImageUpload->resize(300,200)->stream();
                        Storage::disk('s3')->put($thumbnailPath .$name, $ImageUpload->__toString());

                        // for saving to database
                        $images[]=$name;
                        $all_data['images'] = implode("|",$images);

                        // Remove old images
                        if(count($photos) > 0){
                            //  dd($photos);
                            foreach($photos as $photo){
                                $path1 = 'uploads/images/';
                                $path2 = 'uploads/thumbnails/';
                                // Delete old image from file
                                Storage::disk('s3')->delete(parse_url($path1 .$photo));
                                Storage::disk('s3')->delete(parse_url($path2 .$photo));
                            }
                        }

                    }
                }

                if($all_data['removeImages'] === '1'){
                    // Remove old images
                    if(count($photos) > 0){
                        //  dd($photos);
                        foreach($photos as $photo){
                            $path1 = 'uploads/images/';
                            $path2 = 'uploads/thumbnails/';
                            // Delete old image from file
                            Storage::disk('s3')->delete(parse_url($path1 .$photo));
                            Storage::disk('s3')->delete(parse_url($path2 .$photo));
                        }
                    }
                    $all_data['images'] = null;
                }


                if($all_data['docsUpdate'] === 1){
                    $doc = $all_data['documents'];
                    // get the name of the image
                    $name = $doc->hashName();
                    $path = 'uploads/documents/'  .$name;
                    Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
                    $all_data['documents'] = $name;

                    // Delete old deocuments from file
                    if($appointment->documents != '') {
                        $path = 'storage/uploads/documents/';
                        Storage::disk('s3')->delete(parse_url($path .$appointment->documents));
                    }
                }

                if($all_data['removeDocument'] === '1'){

                    // Delete old deocuments from file
                    if($appointment->documents != '') {
                        $path = 'storage/uploads/documents/';
                        Storage::disk('s3')->delete(parse_url($path .$appointment->documents));
                    }
                    $all_data['documents'] = null;
                }


                if($all_data['job_description'] == 'Others'){
                    $all_data['job_description'] = $all_data['other_description'];
                }else{
                    $all_data['job_description'] = $all_data['job_description'];
                }

                $all_data['job_location'] = implode(', ' , $all_data['job_location']);
                // dd($all_data);

                $appointment->update($all_data);

            }

            public function closeRestoration($data)
            {
                $id = $data['id'];

                $image = auth()->id();
                $admin = User::where('role', 'scheduler')
                ->get();

                $url = route('appointment.info', $id);

                $closedDetails = [
                    'body' => 'Job Order No. ' .$id .' is completed and is closed.',
                    'url' => $url,
                    'sender' => $image,
                ];

                if($data['closing_attachment']){
                    $doc = $data['closing_attachment'];
                    // get the name of the image
                    $name = $doc->hashName();
                    $path = 'uploads/documents/'  .$name;
                    Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
                    $data['closing_attachment'] = $name;
                }

                // Update Appointment
                $updateStatus = ClientAppointment::whereid($id)->update(array('status' => 1, 'closing_attachment' => $name ?? null));

                // Update Facilities Status
                $building = Building::whereid($data['building_id'])
                ->update(array('status' => 0));

                Notification::send($admin, new ClosedAppointmentNotification($closedDetails));
            }


        }
