<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Building;
use App\Models\Occupancy;
use App\Models\ClientAppointment;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {

        $user = User::find(auth()->id());
        // Check if the user has an assigned Houser
        if(in_array($user->userTenant(), [2,3])) {
            if(auth()->user()->reset == 0){
                return redirect()->route('reset.password');
            }
            $tenantFacilityId = $user->tenantActiveFacilityId();
            // $app_created = DB::table('client_appointments')->wherebuilding_id($tenantFacilityId)->count();
            $app_created = DB::table('client_appointments')->wherebuilding_id($tenantFacilityId)->whereuser_id($user->badge)->count();
            $surveyScores = ClientAppointment::wherebuilding_id($tenantFacilityId)->where('status', 1)->where('survey_status', 0)->get();
            $open = DB::table('client_appointments')->wherebuilding_id($tenantFacilityId)->whereuser_id($user->badge)->where('status', 0)->count();
            $closed = DB::table('client_appointments')->wherebuilding_id($tenantFacilityId)->whereuser_id($user->badge)->where('status', 1)->count();
            $cancelled = DB::table('client_appointments')->wherebuilding_id($tenantFacilityId)->whereuser_id($user->badge)->where('status', 2)->count();
            $houseInfo = Occupancy::wherebuilding_id($tenantFacilityId)
                ->wherestatus(1)
                ->first();

            return view('dashboard.tenant', compact('houseInfo', 'app_created', 'open', 'closed', 'surveyScores', 'cancelled', 'open', 'closed', 'cancelled',));

            // Check if the user role is not tenant and  staff
        }elseif(auth()->user()->role != 'tenant' && auth()->user()->role != 'staff') {

            // Assigned Facilities
            $occupied = Occupancy::select(DB::raw("COUNT(*) as count"))
            ->wherehas('tenant')
            ->where('status', 1)
            ->pluck('count');

            // Total Restoration
            $restoration = Building::select(DB::raw("COUNT(*) as count"))
            ->whereNotIn('facility_type_id',[9,10,11])
            ->where('status', 4)
            ->pluck('count');

            // Total Facilities
            $totalFacilities = Building::select(DB::raw("COUNT(*) as count"))
            ->whereNotIn('facility_type_id',[9,10,11])
            ->pluck('count');

            // Vacant Facilities
            $vacant = Building::select(DB::raw("COUNT(*) as count"))
            ->whereNotIn('facility_type_id',[9,10,11])
            ->where('status', 0)
            ->pluck('count');

            // Vacant Facilities for 2 Bedroom
            $vacantTwoBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [1,2])
            ->where('status', 0)
            ->pluck('count');

            // Occupied Facilities for 2 Bedroom
            $occupiedTwoBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->wherehas('occupancy', function($q){
                $q->wherestatus(1);
            })
            ->whereIn('facility_type_id', [1,2])
            ->pluck('count');

            // Restoration Facilities for 2 Bedroom
            $restorationTwoBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [1,2])
            ->where('status', 4)
            ->pluck('count');

            // Vacant Facilities for 3 Bedroom
            $vacantThreeBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [3,4])
            ->where('status', 0)
            ->pluck('count');

            // Occupied Facilities for 3 Bedroom
            $occupiedThreeBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->wherehas('occupancy', function($q){
                $q->wherestatus(1);
            })
            ->whereIn('facility_type_id', [3,4])
            ->pluck('count');

            // Restoration Facilities for 3 Bedroom
            $restorationThreeBedroom = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [3,4])
            ->where('status', 4)
            ->pluck('count');

            // Vacant Facilities for 4 Bedroom Attached
            $vacantFourBedroomAttached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [5])
            ->where('status', 0)
            ->pluck('count');

            // Occupied Facilities for 4 Bedroom Attached
            $occupiedFourBedroomAttached = Building::select(DB::raw("COUNT(*) as count"))
            ->wherehas('occupancy', function($q){
                $q->wherestatus(1);
            })
            ->whereIn('facility_type_id', [5])
            ->pluck('count');

            // Restoration Facilities for 4 Bedroom Attached
            $restorationFourBedroomAttached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [5])
            ->where('status', 4)
            ->pluck('count');

            // Restoration Facilities for 4 Bedroom Detached
            $vacantFourBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [6,7])
            ->where('status', 0)
            ->pluck('count');

            // Occupied Facilities for 4 Bedroom Detached
            $occupiedFourBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->wherehas('occupancy', function($q){
                $q->wherestatus(1);
            })
            ->whereIn('facility_type_id', [6,7])
            ->pluck('count');

            // Restoration Facilities for 4 Bedroom Detached
            $restorationFourBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [6,7])
            ->where('status', 4)
            ->pluck('count');

            // Restoration Facilities for 5 Bedroom Detached
            $vacantFiveBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [8])
            ->where('status', 0)
            ->pluck('count');

            // Occupied Facilities for 5 Bedroom Detached
            $occupiedFiveBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->wherehas('occupancy', function($q){
                $q->wherestatus(1);
            })
            ->whereIn('facility_type_id', [8])
            ->pluck('count');

            // Restoration Facilities for 5 Bedroom Detached
            $restorationFiveBedroomDetached = Building::select(DB::raw("COUNT(*) as count"))
            ->whereIn('facility_type_id', [8])
            ->where('status', 4)
            ->pluck('count');

            // For Open Status
            $appointments = ClientAppointment::select(DB::raw("COUNT(*) as count"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(0)
            ->pluck('count');

            $months = ClientAppointment::select(DB::raw("Month(date) as month"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(0)
            ->pluck('month');
            $openChart = array(0,0,0,0,0,0,0,0,0,0,0,0);
            foreach($months as $index => $month){
                $openChart[$month -1 ] = $appointments[$index];
            }

            // For Closed Status
            $appointments2 = ClientAppointment::select(DB::raw("COUNT(*) as count"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(1)
            ->pluck('count');
            $months2 = ClientAppointment::select(DB::raw("Month(date) as month"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(1)
            ->pluck('month');
            $closedChart = array(0,0,0,0,0,0,0,0,0,0,0,0);
            foreach($months2 as $index => $month2){
                $closedChart[$month2 -1 ] = $appointments2[$index];
            }

            // For Cancelled Status
            $appointments3 = ClientAppointment::select(DB::raw("COUNT(*) as count"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(2)
            ->pluck('count');
            $months3 = ClientAppointment::select(DB::raw("Month(date) as month"))
            ->whereYear('date', date('Y'))
            ->groupBy(DB::raw("Month(date)"))
            ->wherestatus(2)
            ->pluck('month');
            $cancelledChart = array(0,0,0,0,0,0,0,0,0,0,0,0);
            foreach($months3 as $index => $month3){
                $cancelledChart[$month3 -1 ] = $appointments3[$index];
            }

            $app_created = DB::table('client_appointments')->count();
            $open = DB::table('client_appointments')->where('status', 0)->count();
            $closed = DB::table('client_appointments')->where('status', 1)->count();
            $cancelled = DB::table('client_appointments')->where('status', 2)->count();
            $houseInfo = null;
            $surveyScores = null;


            return view('dashboard', compact('houseInfo', 'app_created', 'open', 'closed', 'occupied', 'vacant', 'restoration',
            'surveyScores', 'cancelled', 'open', 'closed', 'cancelled','openChart', 'closedChart', 'cancelledChart',
            'totalFacilities', 'vacantTwoBedroom', 'occupiedTwoBedroom', 'restorationTwoBedroom',
            'vacantThreeBedroom', 'occupiedThreeBedroom', 'restorationThreeBedroom',
            'vacantFourBedroomAttached', 'occupiedFourBedroomAttached', 'restorationFourBedroomAttached',
            'vacantFourBedroomDetached', 'occupiedFourBedroomDetached', 'restorationFourBedroomDetached',
            'vacantFiveBedroomDetached', 'occupiedFiveBedroomDetached', 'restorationFiveBedroomDetached'));

        }else {

            // if the user role is staff with no house assigned
            return view('dashboard.guest');
        }

    }
}
