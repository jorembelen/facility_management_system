<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Building;
use App\Models\Occupancy;
use Illuminate\Http\Request;
use App\Http\Requests\AssignRequest;
use App\Http\Requests\CheckinRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\AssignedNotification;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminAssignedNotification;

class RepresentativeController extends Controller
{
    public function index(Request $request)
    {
        $buildings = Occupancy::with('tenant', 'building')
        ->wherestatus(1)
        ->latest()
        ->get();

        return view('occupancies.index', compact('buildings'));
    }

    public function occupiedPerType($id)
    {
        if($id == 2) {
            $type = [1,2];
        }elseif($id == 3){
            $type = [3,4];
        }elseif($id == 4){
            $type = [5];
        }elseif($id == 44){
            $type = [6,7];
        }elseif($id == 5){
            $type = [8];

        }
        $buildings = Occupancy::with('tenant')
            ->whereHas('building', function($q) use($type){
                $q->whereIn('facility_type_id', $type);
            })
            ->wherestatus(1)
            ->latest()
            ->get();

        return view('occupancies.index', compact('buildings'));
    }

    public function addTenant(Request $request)
    {
        $user = User::wherebadge($request->badge)->orwhere('username', $request->username)->first();
        if(!$user) {
            User::Create($request->except('role'));
            Alert::success('Success', 'Tenant was added successfully!');
        }else{
            Alert::error('Failed', 'Tenant was already exist on database!');
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function repVacant()
    {
        $buildings = Building::wherestatus(0)->get();
        $total = $buildings->count();

        return view('representative.vacants', compact('buildings', 'total'));
    }

    public function repVacantPerType($id)
    {
        if($id == 2) {
            $type = [1,2];
        }elseif($id == 3){
            $type = [3,4];
        }elseif($id == 4){
            $type = [5];
        }elseif($id == 44){
            $type = [6,7];
        }elseif($id == 5){
            $type = [8];

        }
        $buildings = Building::whereIn('facility_type_id', $type)
            ->wherestatus(0)
            ->get();
        $total = $buildings->count();

        return view('representative.vacants', compact('buildings', 'total'));
    }

    public function assignTenant($id)
    {
        $facility = Building::findOrFail($id);
        $tenants = User::whereDoesntHave('building')->whererole('staff')->get();

        return view('assigner.assign', compact('tenants', 'facility'));
    }

    public function assignStore(AssignRequest $request)
    {
        $checkin = new Occupancy();

        $data = $request->validated();;
        $checkin->create($data);

        $image = auth()->id();

        $tenant = User::findOrFail($request->tenant_id);
        $admin = User::where('role', 'supervisor')
        ->orWhere('role', 'scheduler')
        ->get();

        $url = route('occupancies.assigned');
        $building = Building::whereid($request->building_id)->first();

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
        $user = Building::whereid($request->building_id)
        ->update(array('status' => 1, 'tenant_id' => $request->tenant_id));

        // Notification for Tenant
        $details = [
            'greeting' => 'Dear '.$tenant->name.',',
            'body' => $body,
            'note' => $note,
            'info' => 'Facility Info.: ',
            'details' => $details,
        ];

        // Notification for Admin
        $adminDetails = [
            'url' => $url,
            'sender' => $image,
            'notifyAdmin' => $tenant->name .' was assigned by '.auth()->user()->name,
        ];

        Notification::send($admin, new AdminAssignedNotification($adminDetails));
        // Notification::send($tenant, new AssignedNotification($details));
        Alert::toast('Tenant was Assigned successfully!', 'success');

        return redirect(route('facilities.vacant'));
    }

    public function reqCheckout()
    {
        return view('representative.req-checkout');
    }

    public function checkout()
    {
        $occupancy = Building::wherestatus(2)->get();
        $total = $occupancy->count();

        return view('representative.checkout', compact('occupancy', 'total'));
    }

    public function appCheckout(Request $request)
    {
        dd($request);
        $building = Building::whereid($request->building_id)
        ->wheretenant_id($request->tenant_id)
        ->first();
        $building->update(array('status' => 4));
        Alert::toast('You approved checkout request successfully', 'success');

        return back();
    }

    public function assigned()
    {
        return view('representative.assigned');
    }

}
