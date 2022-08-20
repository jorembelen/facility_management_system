@extends('layouts.master')

@section('title', 'Help Page')
@section('content')

<style>
    .modal-dialog{
        max-width: 800px;
        margin: 30px auto;
    }



    .modal-body{
        position:relative;
        padding:0px;
    }
    .close {
        position:absolute;
        right:-30px;
        top:0;
        z-index:999;
        font-size:2rem;
        font-weight: normal;
        color:#fff;
        opacity:1;
    }
</style>

<div class="row">
    <div class="col-12 col-lg-12">

        @if (auth()->user()->isTenant())
        <div class="card">
            <div class="card-body pt-4">
                <h5 class="card-title">How to login to Alwaha FMS  for the 1st time.</h5>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary login-video-btn" data-toggle="modal" data-src="{{ Storage::disk('s3')->url('help-assets/login.mp4') }}" data-target="#loginModal">Click here to watch the video</button>
                    </div>
                </div>
                <br>
                <ol>
                    <li> Go to your Sadara Email and check the mail from Alwaha FMS </li>
                    <li> Click on the button in the middle that says “Click Here” to reset your password </li>
                    <li> Enter your username from the email you received </li>
                    <li> Enter your temporary password from the email you receive </li>
                    <li> Then click login button </li>
                    <li> Type your desired password in the two boxes then click submit </li>
                    <li> You should be in the dashboard </li>

                </ol>

                <hr>

                <h5 class="card-title">How to create an appointment.</h5>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-info create-video-btn" data-toggle="modal" data-src="{{ Storage::disk('s3')->url('help-assets/appointmentCreation.mp4') }}" data-target="#createModal">Click here to watch the video</button>
                    </div>
                </div>
                <br>
                <ol>
                    <li> Login to https://alwahafms.com and type your username and password.</li>
                    <li> From the left side menu, click on Create Appointments</li>
                    <li> Click on  “Choose work category”  then click on “Choose date” note: no appointments of Friday)</li>
                    <li> Then select the appointment time.</li>
                    <li> Choose the issue / complaint</li>
                    <li> Choose the location (you can choose multiple locations)</li>
                    <li> Attach images (optional)</li>
                    <li> Attach related documents (optional)</li>
                    <li> Click submit and you are done (note that you will be receiving an email confirmation about the appointment)</li>
                    <br>
                    <img src="{{ asset('assets/img/help/appointment-notification.png') }}" alt="appointment-img">
                    <li class="mt-4"> Once your appointment is completed, you will receive an email that indicates that it is closed and allows your to provide your satisfaction rating for the appointment as shown below.</li>
                    <br>
                    <img src="{{ asset('assets/img/help/closed-appointment-notification.png') }}" alt="closed-appointment-img">

                </ol>

                <hr>

                <h5 class="card-title">How to create a survey.</h5>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-success survey-video-btn" data-toggle="modal" data-src="{{ Storage::disk('s3')->url('help-assets/create_Survey.mp4') }}" data-target="#surveyModal">Click here to watch the video</button>
                    </div>
                </div>
                <br>
                <ol>
                    <li>There are two ways to create a survey. Option 1. From appointment closing email from the system. Option 2 is from the website as follows:</li>

                    <li>Login to https://alwahafms.com and type your username and password.</li>
                    <li>From the left side menu click on Appointments.</li>
                    <li>Click “Closed”  tab below appointment Manager from there, you will see the history of appointments.  Look for the part the says “Satisfaction score” and you will see some
                        ratings below it.  Look for appointments that says “Give us your rating” and click it.</li> <br>
                        <img class="mt-2 mb-4" src="{{ asset('assets/img/help/survey-result.png') }}" alt="survey-result-img" > <br>
                        <img class="mb-2  mb-4" src="{{ asset('assets/img/help/survey.png') }}" alt="survey-img">
                        <br>
                        <li>You will see the appointment details and area to choose score. Choose the score between 5 – 1 as per below ratings.</li>
                        <ul>
                            <li>5 – Excellent</li>
                            <li>4 – Very Good</li>
                            <li>3 – Satisfactory</li>
                            <li>2 – Needs Improvement</li>
                            <li>1 – Poor</li>

                        </ul>
                        <li>Leave your comments (Optional but recommended)</li>
                        <li>Click Submit</li>

                    </ol>
                    <hr>
                    <h5 class="card-title">How to logout.</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-danger logout-video-btn" data-toggle="modal" data-src="{{ Storage::disk('s3')->url('help-assets/Logout.mp4') }}" data-target="#logoutModal">Click here to watch the video</button>
                        </div>
                    </div>

            </div>
        </div>
        @else
        <div class="text-center mt-4">
            <h1>Coming Soon ...</h1>
        </div>
        @endif

    </div>
</div>



@include('help.login-modal')
@include('help.logout-modal')
@include('help.create-modal')
@include('help.survey-modal')

@endsection


