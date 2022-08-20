<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Building;
use App\Models\Checkout;
use App\Models\Occupancy;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    protected function assignedTotal()
    {
        return  $assTotal = count(Building::wherestatus(1)->get());
    }

    public function checkoutView($id)
    {

        $tenant = User::findOrFail($id);

       return view('checkout.index', compact('tenant'));
    }


    // This is for RCL Supervisor
    public function checkOut(CheckoutRequest $request)
    {
        $data = $request->validated();
        $tenant = User::find($request->tenant_id);
        $occupancy = Occupancy::wheretenant_id($request->tenant_id)
        ->wherebuilding_id($request->building_id)
        ->wherestatus(1)
        ->firstOrFail();

        if($request->checkout_date < $occupancy->checkin_date){
            Alert::error('Failed, Checkout date should be greater than Checkin date.');
            return back();
        }

        $checkout = new Checkout();

        if($request->hasfile('attachment')){
            $doc = $request->file('attachment');

            // get the name of the image
            $name = $doc->hashName();
            $path = 'uploads/documents/';
            Storage::disk('s3')->put($path .$name, file_get_contents($doc));
            $data['attachment'] = $name;
        }

        // return $data;
        $checkout->create($data);


        $building = Building::whereid($request->building_id)
        ->wheretenant_id($request->tenant_id)
        ->update(array('status' => 4, 'tenant_id' => null));


        $occupancy->update(array('status' => 0));

        // Update User Role
        $tenant->update(array('role' => 'staff'));

        Alert::toast('Tenant was Checked Out successfully!', 'success');

        return back();

    }
}
