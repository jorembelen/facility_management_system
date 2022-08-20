@section('title', 'Create Appointment')

<div>

    <style>
        .spinner-border {
            position: absolute;
            margin: auto;
            left: 0;
            right: 0;
            top: 200%;
            bottom: 0;
            width: 80px;
            height: 80px;
        }
    </style>

    <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('prevMaint') }}" type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back
                    </a>
                </div>

                @if ($selectScheduleShow)
                <div class="card-body">
                    <form wire:submit.prevent="getSchedule">
                        <div class="alert alert-primary alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="alert-icon">
                                <i class="far fa-fw fa-bell"></i>
                            </div>
                            <div class="alert-message">
                                <strong>Hello there!</strong> Please select Tenant, work category and date to proceed!
                            </div>
                        </div>
                        <div wire:loading.remove wire:target="getSchedule">

                            <div class="form-group">
                                <label class="form-label">Tenant Name</label>
                                <div wire:ignore>
                                    <select wire:model="tenant_id" class="form-control select2" id="tenant" >
                                        <option value="">Select ...</option>
                                        @foreach ($tenants as $tenant)
                                        <option value="{{ $tenant->badge }}" @if (old('tenant_id') == $tenant->id) selected="selected" @endif>{{ $tenant->badge }} - {{ $tenant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tenant_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="form-label">Work Category</label>
                                <div wire:ignore>
                                    <select wire:model="category" class="form-control select2" id="category">
                                        <option value="">Select Work Category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category') == $category->id) selected="selected" @endif>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('category')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="date" placeholder="select date">
                                </div>@error('date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary waves-effect waves-light">Check Schedule</button>
                        </div>
                        <div class="spinner-border text-primary" role="status" wire:loading wire:target="getSchedule">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </form>
                </div>

                @else
                <div class="card-body">
                    <form wire:submit.prevent="createAppointment">
                        <div class="form-group">
                            <label class="form-label">Tenant Name </label>
                            <h4>{{ $tenantName }}  </h4>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Work Category</label>
                            <h3>{{ $workCategory->name }}</h3>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <h3>{{ date('M-d-Y', strtotime($date)) }}</h3>
                        </div>
                        <hr>
                        @if ($emergencyTime)
                        <div class="form-group">
                            <h3>Appointment Time</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Start</label>
                                    <div wire:ignore>
                                        <input type="text" class="form-control flatpickr flatpickr-input active" id="timeOne" wire:model.defer="time_start" placeholder="select start time">
                                    </div>
                                    @error('time_start')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">End</label>
                                    <div wire:ignore>
                                        <input type="text" class="form-control flatpickr flatpickr-input active" id="timeTwo" wire:model.defer="time_end" placeholder="select end time">
                                    </div>
                                    @error('time_end')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        @include('scripts.scheduler-appointment-two')
                        @else
                        <div class="form-group">

                            <h4>Select Appointment Time</h4>
                            <div wire:ignore>
                                @foreach ($schedules as $item)
                                <label class="form-check form-check-inline mr-4">
                                    <input class="form-check-input" type="radio" value="{{ $item->time }}" wire:model.defer="schedule_time" name="radios-example" {{ $item->slot <= 0 ? 'disabled' : 'checked' }}>
                                    <span class="form-check-label">
                                        {{ $item->time }}
                                    </span>
                                </label>
                                @endforeach

                            </div>
                            @error('schedule_time')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="form-label">Job Description</label>
                            <div wire:ignore>
                                <select wire:model="job_description" class="form-control" id="appointment_frm">
                                    <option value="">Select ...</option>
                                    @foreach ($options as $option)
                                    <option value="{{ $option->name }}">{{ $option->name }}</option>
                                    @endforeach
                                    <option value="Others">Others</option>
                                </select>
                            </div>
                            @error('job_description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group" style="display:{{ $job_description == 'Others' ? '' : 'none' }}">
                            <label class="form-label">Others</label>
                            <textarea wire:model.defer="other_description" class="form-control" value="{{ old('other_description') }}" cols="30" rows="3" placeholder="Please provide other description"></textarea>
                            @error('other_description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group" >
                            <label class="form-label">Location</label>
                            <div wire:ignore>
                                <select wire:change="$emit('classChanged', $event.target.value)" class="form-control workLocation" id="location" multiple>
                                    <option>Select</option>
                                    @foreach ($locations as $item)
                                    <option value="{{ $item->location }}">{{ $item->location }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('job_location')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label w-100"><strong>Attach Image(s) إرفاق الصورة (الصور)</strong></label>
                            <input type="file"  wire:model="images"  multiple>

                            @error('images.*')
                            <div class="text-danger ">
                                {{ $message }}
                            </div>
                            @enderror
                            @if (!empty($images))
                            <div class="row mt-4">
                                @foreach ($images as $image)
                                <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3 img-wrap">
                                    <div wire:key="{{$loop->index}}">
                                        <a href="#" wire:click.prevent="removeMe({{$loop->index}})"><span class="close">&times;</span></a>
                                        <img src="{{ $image->temporaryUrl() }}" class="card-img-top" alt="attach image" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="row mt-4">
                                <div class="col-6 col-md-4 col-lg-4 col-sm-6 col-xl-3">
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="Unsplash" >
                                </div>
                            </div>
                            @endif

                        </div>

                        <div class="form-group">
                            <div wire:ignore>
                                <label for="docs" class="form-label w-100"><strong>Attached Documents (pdf) المستندات المرفقة (pdf)</strong><span class="text-danger"> </span></label>
                                <input type="file"   wire:model.defer="documents">
                            </div>
                            @error('documents')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            @if ($documents && $documents->getClientOriginalExtension() == 'pdf')
                            <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3">
                                <img src="{{ asset('assets/img/pdf.png') }}" class="card-img-top" alt="attach image" >
                            </div>
                            @endif
                        </div>

                        <div class="modal-footer">
                            <div wire:loading wire:target="createAppointment" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                            <div wire:loading wire:target="images" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading . . .</div>

                            <div wire:loading.remove wire:target="createAppointment, images">
                                <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                                <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('prevMaint') }}" type="button" class="btn btn-danger waves-effect">Cancel</a>
                            </div>
                        </div>

                    </form>
                </div>
                @include('scripts.select')
                @endif
            </div>
                    @include('scripts.scheduler-appointment')
        </div>
    </div>

</div>


@push('sched-create-js')
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#tenant').select2();
            $('#category').select2();
            $('#location').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('category', $('#category').val());
        @this.set('tenant_id', $('#tenant').val());
        @this.set('job_location', $('#location').val());
    })
</script>


@endpush
