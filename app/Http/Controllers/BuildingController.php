<?php

namespace App\Http\Controllers;

use App\Imports\BuildingsImport;
use App\Models\Building;
use App\Models\JobOrder;
use App\Models\Occupancy;
use App\Models\Occupant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Maatwebsite\Excel\Facades\Excel;

class BuildingController extends Controller
{

    /**
        * Building Status
        * 0 - Vacant
        * 1 - Assigned
        * 2 - Occupied
        * 3 - Applied for Checkout
        * 4 - For Restoration
        * 5 - Under Restoration
        * 6 - For Preventive Maintenance
    */


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buildings = Building::whereNotIn('status', [6])->latest()->get();
        $total = count($buildings);

        return view('buildings.index', compact('buildings', 'total'));
    }

    public function indexperType($id)
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
            ->whereNotIn('status', [6])
            ->latest()
            ->get();
        $total = count($buildings);

        return view('buildings.index', compact('buildings', 'total'));
    }

    public function forCheckout()
    {
        $buildings = Building::wherestatus(4)->latest()->get();
        $total = count($buildings);

        return view('buildings.restoration', compact('buildings', 'total'));
    }

    public function restoration()
    {
        $buildings = Building::with('restoration')->wherestatus(4)->latest()->get();
        $total = count($buildings);

        return view('buildings.restoration', compact('buildings', 'total'));
    }

    public function restorationperType($id)
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
            ->wherestatus(4)
            ->latest()
            ->get();
        $total = count($buildings);

        return view('buildings.restoration', compact('buildings', 'total'));
    }

    public function release(Request $request)
    {
           // Update Facility Status
           $building = Building::whereid($request->building_id)
           ->update(array('status' => 0));

           Alert::success('Success', $request->building_id .' is now ready to be assign!');

        return back();
    }

    public function importIndex()
    {
        return view('buildings.import');
    }

    public function import(Request $request)
    {
        $validator = Excel::import(new BuildingsImport,request()->file('file'));

        Alert::success('Success', 'Facilities Imported Successfully!');

        return redirect(route('facilities.index'));
    }

    public function search(Request $request)
    {
        $str = $request->input('search');

        $buildings = Building::where('unit_no', 'LIKE', '%'.$str.'%')
        ->orWhere('plot', 'LIKE' , '%'.$str.'%')
        ->orWhere('house_no', 'LIKE' , '%'.$str.'%')->get();

        $total = count($buildings);

        if($buildings->count() >0)
        {
            foreach($buildings as $building)
            {
                $id = $building->id;
            }
            $occupant = Occupancy::wherebuilding_id($id)->get();
        }else{
            $occupant = '';
        }

        return view('buildings.search', compact('buildings', 'total', 'occupant'));
    }

    public function jobOrders($id)
    {
        $jobOrders = Building::findOrFail($id)->jobOrder;
        $building = Building::findOrFail($id);
        $buildingId = $building->id;
        $occupant = Occupancy::wherebuilding_id($buildingId)->get();
        foreach($occupant as $data)
        {
            $occupantId = $data->occupant_id;
        }
        $buildingUser = Occupant::findOrFail($occupantId);


        return view('buildings.job-orders', compact('building', 'jobOrders', 'buildingUser'));
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
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $building = Building::findOrFail($id);

        return view('buildings.details', compact('building'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $building = Building::findOrFail($id);

        return view('buildings.edit', compact('building'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        //
    }
}
