<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffStoreRequest;
use App\Models\User;
use App\Models\Building;
use App\Models\Occupant;
use App\Models\Occupancy;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Imports\OccupancyImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

class OccupancyController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $buildings = Occupancy::wherestatus(1)->latest()->get();

        return view('occupancies.index', compact('buildings'));
    }

    public function checkApproved()
    {
        $assigned =  $this->assignedTotal();

        $facilities = Building::wherestatus(4)->get();
        $total = count($facilities);

        return view('occupancies.approved', compact('facilities', 'total', 'assigned'));
    }

    public function assigned()
    {
        return view('occupancies.assigned');
    }

    public function addStaff(StaffStoreRequest $request)
    {
        $user = new User();
        DB::beginTransaction();
        if($user) {
            $user->create($request->validated());

            DB::commit();
            Alert::success('Success', $request->name .' was successfully created!.');
            return redirect()->back();
        }else{
            DB::rollBack();
            Alert::error('Failed', 'Please check your data and try again!');
        }
    }

    public function occAttachment(User $user)
    {
        return view('livewire.supervisor.attachment', compact('user'));

    }

    public function details($id)
    {
        $occupancies = Occupancy::wherebuilding_id($id)->get();

        if($occupancies->count() > 0)
        {
            foreach($occupancies as $data)
            {
                $name = $data->occupant->name;
                $badge = $data->occupant->badge;

            }
        }else{
            $name = '';
            $badge = '';
        }
        $total = count($occupancies);

        return view('occupancies.view', compact('occupancies', 'name', 'total', 'badge'));
    }

    public function search(Request $request)
    {
        $str = $request->input('search');
        $select = $request->input('select');

        $occupancy = new Occupant;
        $unit = new Building();

        if($select == 'occupants')
        {

            $occupants = $occupancy->where('badge', 'LIKE', '%'.$str.'%')->get();
            $total = count($occupants);
            if($occupants->count() > 0)
            {
                 foreach($occupants as $occ)
                 {
                     $id = $occ->id;
                 }
                 $occup = Occupancy::whereoccupant_id($id)->get();
            }else{
                $occup = '';
            }

            return view('occupants.search', compact('occupants', 'total', 'occup'));

        }elseif($select == 'building')
        {
            $buildings = $unit->where('unit_no', 'LIKE', '%'.$str.'%')->get();
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

            $total = count($buildings);

            return view('buildings.search', compact('buildings', 'total', 'occupant'));
        }

        Alert::error('Failed', 'Please select option!');

        return back();
    }

    public function importIndex()
    {
        return view('occupancies.import');
    }

    public function import(Request $request)
    {
        $validator = Excel::import(new OccupancyImport,request()->file('file'));

        Alert::success('Success', 'Occupants Imported Successfully!');

        return redirect(route('occupancies.index'));
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
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $occupancies = Occupancy::whereoccupant_id($id)->get();

        if($occupancies->count() > 0)
        {
            foreach($occupancies as $data)
            {
            $name = $data->occupant->name;
            $badge = $data->occupant->badge;
            }
        }else{
            $name = '';
            $badge = '';
        }

        $total = count($occupancies);

        return view('occupancies.view', compact('occupancies', 'name', 'total', 'badge'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupancy $occupancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Occupancy  $occupancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupancy $occupancy)
    {
        //
    }
}
