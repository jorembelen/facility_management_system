
    @section('title', 'Create Survey')

<div>


<div class="row">
    <div class="col-xl-2"></div>
        <div class="col-lg-8 col-xxl-8">
            <div class="card">
                <div class="card-header">
                    <div class="card-action float-right">
                        <div class="dropdown show">
                        </div>
                    </div>
                    <h3 class="card-title mb-0">Create Survey:</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal form-disabled-button" wire:submit.prevent="addSurvey('{{ $appointmentId }}')">

                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Job Order No. :</dt>
                        <h5>{{ $appointment->id }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Work Category :</dt>
                        <h5>{{ $appointment->category->name }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Date:</dt>
                        <h5>{{ date('M-d-Y', strtotime($appointment->date)) }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Scheduled Time:</dt>
                        <h5>{{ $appointment->schedule_time }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Job Description:</dt>
                        <h5 class="text-justify ml-3 mr-3 mt-2">{{ $appointment->job_description }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Job Location:</dt>
                        <h5 class="text-justify ml-3 mr-3 mt-2">{{ $appointment->job_location }}</h5>
                    </dl><hr>
                    <div class="form-group">
                        <label class="form-label">Score</label>
                        <select wire:model.defer="survey_score" class="form-control">
                            <option>Choose Score ...</option>
                            <option value="5">5 - Excellent</option>
                            <option value="4">4 - Very Good</option>
                            <option value="3">3 - Satisfactory</option>
                            <option value="2">2 - Needs Improvement</option>
                            <option value="1">1 - Poor</option>
                       </select>
                       @error('survey_score')
                       <div class="text-danger ">
                           {{ $message }}
                       </div>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Comments</label>
                        <textarea wire:model.defer="survey_comments" class="form-control" cols="30" rows="6"></textarea>
                        @error('survey_comments')
                        <div class="text-danger ">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <div wire:loading wire:target="addSurvey" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>

                        <div wire:loading.remove wire:target="addSurvey">
                            <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit يُقدِّم</button>
                            <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route( 'appointment.index') }}" type="button" class="btn btn-danger waves-effect">Cancel يلغي</a>
                        </div>
                </form>
                </div>

            </div>
        </div>

</div>

</div>
