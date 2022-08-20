<?php

namespace App\Traits;

use App\Mail\TenantActivation;
use App\Models\User;
use App\Models\Building;
use App\Models\Checkout;
use App\Models\Occupancy;
use App\Notifications\AdminAssignedNotification;
use App\Notifications\AssignedNotification;
use App\Notifications\TenantActivationNotification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

trait TenantTrait {

    public function checkTenantUpgraded()
    {
        $user = User::find($this->badge);
        if($user->upgraded == 3){
            return true;
        }
        return false;
    }

    public function tenantActiveFacilityId()
    {
        $user = User::find($this->badge);
        if($user->upgraded == 3){
            $building = Building::wheretenant_id($this->badge)->get()->last();
            return $building->id;
        }else{
            $building = Building::wheretenant_id($this->badge)->first();
            return $building->id;
        }
    }

    public function tenantActiveFacilityType()
    {
        $user = User::find($this->badge);
        if($user->upgraded == 2){
            $building = Building::wheretenant_id($this->badge)->get()->last();
            return $building->facility_type_id;
        }else{
            $building = Building::wheretenant_id($this->badge)->first();
            return $building->facility_type_id;
        }
    }

    public function userTenant()
    {
        $tenant = Building::wheretenant_id(auth()->id())->first();
        if(isset($tenant)){
            return $tenant->status;
        }
        return null;
    }

    public function tenantBuilding()
    {
        $building = Building::wheretenant_id(auth()->id())->first();
        if(isset($building)){
            return $building->id;
        }
        return null;
    }

    public function tenant()
    {
        $tenant = User::whereusername($this->username)->wherestatus(1)->first();
        if(isset($tenant)){
            return $tenant;
        }
        return null;
    }

    public function checkinTenant($request)
    {
        $tenant = User::find($request['tenant_id']);
        $email = $tenant->email;

        // For Notification
        $image = auth()->id();
        $admin = User::where('role', 'assigner')
        ->get();
        $url = route('facilities.occupied');
        $details = [
            'body' => $tenant->name .' was checked in by '.auth()->user()->name,
            'url' => $url,
            'sender' => $image,
        ];

        if($request['checkin_attachment']){
            $doc = $request['checkin_attachment'];
            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/'  .$name;
            Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
            $attachment = $name;
        }


        // dd($attachment);
        // Update Occupancy Status
        $occupancy = Occupancy::wherebuilding_id($request['id'])
        ->wheretenant_id($request['tenant_id'])
        ->update(array(
            'status' => 1,
            'checkin_date' => $request['checkin_date'],
            'checkedinBy' => auth()->id(),
            'checkin_attachment' => $attachment ?? null
        ));

        // Update Facilities Status
        Building::whereid($request['id'])
        ->wheretenant_id($request['tenant_id'])
        ->update(array(
            'status' => 2,
        ));

        $data_pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle(str_repeat($data_pool, 8)), 0, 8);
        // dd($password);
        // Update User Role
        $tenant->update(array(
            'role' => 'tenant',
            'password' => $password,
            'upgraded' => $request['upgraded'],
        ));

        Mail::to($email)->send(new TenantActivation($tenant, $password));
        Notification::send($admin, new TenantActivationNotification($details));

    }

    public function updateProfile($image)
    {
        $user = User::findOrFail(auth()->id());
        $ImageUpload = Image::make($image);
        $name = $image->hashName();
        $storagePath = 'uploads/thumbnails/';
        $ImageUpload->fit(192)->stream();
        Storage::disk('s3')->put($storagePath .$name, $ImageUpload->__toString());

        // Delete the old Image from the file
        if(auth()->user()->profile_photo_path) {
            Storage::disk('s3')->delete(parse_url($storagePath .$user->profile_photo_path));
        }

        $user->profile_photo_path = $name;
        $user->save();
    }

    public function assignTenant($data)
    {
        $checkin = new Occupancy();

        $checkin->create($data);

        $image = auth()->id();

        $tenant = User::findOrFail($data['tenant_id']);
        $admin = User::where('role', 'supervisor')
        ->orWhere('role', 'scheduler')
        ->get();

        $url = route('occupancies.assigned');
        $building = Building::whereid($data['building_id'])->first();

        $start = now();
        $today = now();
        $end = $today->addDays(14);

        $body = 'We are pleased to announce that the below mentioned housing unit was assigned to you. Please contact AlWaha Service Desk at sadara.servicedesk@rezayat.net  to schedule signing the Housing agreement and start the check in process at AlWaha Maintenance Office. The working hours is process from 8:30 AM to 4:30 PM. ';
        $note = 'Please Note that You will have  14 days to complete check-in to your new assigned housing unit starting from '.$start->format('M-d-Y') .' till '.$end->format('M-d-Y').'.';
        $description = $building->type->name;

        if(in_array($building->facility_type_id, [1,2,3,4]))
        {
               $details = 'RC Bldg.: '.$building->rc_no.' '.', IFC Bldg.: '.$building->ifc_no.' '.', Flat Unit: '.$building->flat_no.' '.', Block: '.$building->block_no.' '.', Street: '.$building->street.' '.' - Type: '.$description;
        }else{
                $details = 'Villa No.: '.$building->villa_no.' '.', Lot: '.$building->lot_no.' '.', Block: '.$building->block_no.' '.', Street: '.$building->street.' '.' - Type: '.$description;

        }

        // Update Facility Status
        $user = Building::whereid($data['building_id'])
        ->update(array('status' => 1, 'tenant_id' => $data['tenant_id']));

        // Notification for Tenant
        $details = [
            'greeting' => 'Dear '.$tenant->name.',',
            'body' => $body,
            'note' => $note,
            'info' => 'Facility Info: ',
            'details' => $details,
        ];

        // Notification for Admin
        $adminDetails = [
            'url' => $url,
            'sender' => $image,
            'notifyAdmin' => $tenant->name .' was assigned by '.auth()->user()->name,
        ];

        Notification::send($admin, new AdminAssignedNotification($adminDetails));
        Notification::send($tenant, new AssignedNotification($details));
    }

    public function checkoutTenant($data)
    {
        $occupancy = Occupancy::wheretenant_id($data['tenant_id'])
        ->wherebuilding_id($data['building_id'])
        ->wherestatus(1)
        ->firstOrFail();
        $checkout = new Checkout();

        if($data['attachment']){
            $doc = $data['attachment'];
            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/'  .$name;
            Storage::disk('s3')->put($path, file_get_contents($doc->getRealPath()));
            $data['attachment'] = $name;
        }

        // return $data;
        $checkout->create($data);


        $building = Building::whereid($data['building_id'])
        ->wheretenant_id($data['tenant_id'])
        ->update(array(
            'status' => 4,
            'upgraded' => 0,
            'tenant_id' => null
        ));
        $occupancy->update(array('status' => 0));

    }


}


// $user = \LdapRecord\Models\ActiveDirectory\User::findByOrFail('samaccountname', 'delore00')->getOriginal();
