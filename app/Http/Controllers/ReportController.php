<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use App\Models\Occupancy;
use App\Models\WorkCategory;
use Illuminate\Http\Request;
use App\Models\ClientAppointment;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    public function appointmentReportIndex()
    {

      return view('reports.appointments-report');
    }

    public function appointmentReport(Request $request)
    {
        $categories = WorkCategory::all();

        $appointments = new ClientAppointment();

        if($request->work_category_id) {
            $category = WorkCategory::findOrFail($request->work_category_id);
            $categoriesName = $category->name;
            $appointments =  $appointments->wherework_category_id($request->work_category_id);
        }else{
            $categoriesName = '';
        }

        if($request->status) {
            $appointments =  $appointments->wherestatus($request->status);
        }

        if($request->start_date) {
            $appointments = $appointments->where('date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $appointments = $appointments->where('date', '<=', $request->end_date);
        }

        if($request->end_date < $request->start_date){
            Alert::error('Error', 'End date should be greater than Start date!');
        }

        $appointments = $appointments->latest()->get();

      return view('reports.appointments', compact('appointments', 'categories', 'categoriesName'));
    }

    public function checkinReportIndex()
    {

        return view('reports.checkin-report');
    }

    public function checkinReport(Request $request)
    {
        $buildings = new Occupancy;

        if($request->start_date) {
            $buildings = $buildings->with('building')->where('checkin_date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $buildings = $buildings->with('building')->where('checkin_date', '<=', $request->end_date);
        }

        if($request->end_date < $request->start_date){
            Alert::error('Error', 'End date should be greater than Start date!');
        }

        $buildings = $buildings->with('building')->wherestatus(1)->orderBy('checkin_date', 'ASC')->get();
        $total = count($buildings);

        return view('reports.checkin', compact('buildings', 'total'));
    }

    public function checkoutReportIndex(Request $request)
    {
        return view('reports.checkout-report');
    }

    public function checkoutReport(Request $request)
    {
        $checkout = new Checkout();

        if($request->start_date) {
            $checkout = $checkout->where('checkout_date', '>=', $request->start_date);
        }

        if($request->end_date) {
            $checkout = $checkout->where('checkout_date', '<=', $request->end_date);
        }

        if($request->end_date < $request->start_date){
            Alert::error('Error', 'End date should be greater than Start date!');
        }

        $checkout = $checkout->wherehas('tenant')->latest()->get();

        return view('reports.checkout', compact('checkout'));
    }
}
