<?php

namespace App\Http\Livewire;

use App\Models\ClientAppointment;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $appointment = [];
    public $scores = [];
    public $showModal = false;

    public function mount()
    {
        $this->scoreOne = [];
        $appointments = DB::table('client_appointments')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(1)
        ->pluck('count');

        $months = DB::table('client_appointments')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(1)
        ->pluck('month');
        $this->scoreOne = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->scoreOne[$month -1 ] = $appointments[$index];
        }
        $this->scoreTwo = [];
        $appointments = DB::table('client_appointments')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(2)
        ->pluck('count');

        $months = DB::table('client_appointments')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(2)
        ->pluck('month');
        $this->scoreTwo = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->scoreTwo[$month -1 ] = $appointments[$index];
        }
        $this->scoreThree = [];
        $appointments = DB::table('client_appointments')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(3)
        ->pluck('count');

        $months = DB::table('client_appointments')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(3)
        ->pluck('month');
        $this->scoreThree = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->scoreThree[$month -1 ] = $appointments[$index];
        }
        $this->scoreFour = [];
        $appointments = DB::table('client_appointments')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(4)
        ->pluck('count');

        $months = DB::table('client_appointments')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(4)
        ->pluck('month');
        $this->scoreFour = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->scoreFour[$month -1 ] = $appointments[$index];
        }
        $this->scoreFive = [];
        $appointments = DB::table('client_appointments')->select(DB::raw("COUNT(*) as count"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(5)
        ->pluck('count');

        $months = DB::table('client_appointments')->select(DB::raw("Month(date) as month"))
        ->whereYear('date', date('Y'))
        ->groupBy(DB::raw("Month(date)"))
        ->where('status', 1)->where('survey_status', 1)->wheresurvey_score(5)
        ->pluck('month');
        $this->scoreFive = array(0,0,0,0,0,0,0,0,0,0,0,0);
        foreach($months as $index => $month){
            $this->scoreFive[$month -1 ] = $appointments[$index];
        }
    }

    public function render()
    {
        $surveyScores = ClientAppointment::where('status', 1)->where('survey_status', 1)->paginate(5);

        return view('livewire.dashboard-component', compact('surveyScores'));
    }

    public function view(ClientAppointment $app)
    {
        $this->dispatchBrowserEvent('show-form');
        $this->appointment = $app;
        $this->showModal = true;
    }

    public function close()
    {
        $this->dispatchBrowserEvent('hide-scoreForm');
    }

}
