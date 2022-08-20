<?php

namespace App\Http\Livewire\Tenants;

use App\Models\ClientAppointment;
use App\Models\User;
use App\Notifications\Representative\SurveyNotifications;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class Survey extends Component
{

    public $appointmentId, $survey_score, $survey_comments;

    public function mount($appointmentId)
    {
        session()->put('previousRoute', url()->previous());
        $this->appointmentId = $appointmentId;
    }

    public function render()
    {
        $appointment = ClientAppointment::find($this->appointmentId);

        return view('livewire.tenants.survey', compact('appointment'))->extends('layouts.master');
    }

    public function addSurvey(ClientAppointment $appointment)
    {
        $this->validate([
            'survey_score' => 'required',
            'survey_comments' => 'required_if:survey_score,2,1',
        ]);

        if($appointment->user_id == auth()->user()->badge){
            DB::beginTransaction();
            if($appointment) {
                ClientAppointment::whereid($appointment->id)
                ->update(array(
                    'survey_score' => $this->survey_score,
                    'survey_comments' => $this->survey_comments,
                    'survey_status' => 1,
                ));

                DB::commit();

                // If the survey score is poor send email to Sadara Representative
                // if($this->survey_score == 1){
                //     $email = User::whererole('representative')->get();
                //     $details = [
                //         'greetings' => 'Greetings,',
                //         'body' => 'Appointment ID: ' .$appointment->id .' survey was done with the score of: ' .$appointment->survey_score .' which is ' .$appointment->surveyScore() .'.',
                //         'notice' => 'To view the details of this appointment, please click the link below.',
                //         'url' => route('survey.show', $appointment->id)
                //     ];

                //     Notification::send($email, new SurveyNotifications($details));
                // }


                $this->dispatchBrowserEvent('swal:modal', [
                    'type' => 'success',
                    'title' => 'Thank you for your feedback!',
                    'text' => '',
                ]);
                return redirect('client-appointments');
            }else{
                DB::rollBack();
                return redirect()->back();
            }

        }else{
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'error',
                'title' => 'Sorry, You are not allowed to give survey for this appointment!',
                'text' => '',
            ]);
            return;
        }

    }


}
