@section('title', 'Restoration')

<div>

    <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('restoration.list') }}" type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back
                    </a>
                    <h2 class="text-center">Create Restoration Appointment</h2>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                    <div class="form-group">
                        <label class="form-label">Select Facility</label>
                        <div wire:ignore>
                            <select wire:change="$emit('classChanged', $event.target.value)"  class="form-control select2" id="building">
                                <option value="">None</option>
                                @foreach ($facilities as $facility)
                                <option value="{{ $facility->id }}">{{ $facility->id }} - {{ $facility->type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('building_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Appointment Date</label>
                        <div wire:ignore>
                            <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="date" placeholder="select date">
                        </div>
                        @error('date')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Appointment Time</label>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label">Start</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="timeFlatpickr" wire:model.defer="time_start" placeholder="select start time">
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
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="timeTwoFlatpickr" wire:model.defer="time_end" placeholder="select end time">
                                </div>
                                @error('time_end')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Job Description</label>
                        <textarea wire:model.defer="job_description" class="form-control" cols="30" rows="6"></textarea>
                        @error('job_description')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="form-label">Attach Image(s)</label>
                        <input type="file" class=" form-control" wire:model="images"  multiple>

                        @error('images.*')
                        <div class="text-danger ">
                            {{ $message }}
                        </div>
                        @enderror
                        @if (!empty($images))
                        <div class="row mt-4">
                            @foreach ($images as $image)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <img src="{{ $image->temporaryUrl() }}" class="card-img-top" alt="attach image" >
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="row mt-4">
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                <img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="Unsplash" >
                            </div>
                        </div>
                        @endif

                    </div>

                    <div class="form-group">
                        <div wire:ignore>
                            <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                            <input type="file" class="form-control"  wire:model="documents">
                        </div>
                        @error('documents')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <div wire:loading wire:target="images" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading . . .</div>

                    <div wire:loading.remove wire:target="submit, images">
                        <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                        <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('restoration.list') }}" type="button" class="btn btn-danger waves-effect">Cancel</a>
                    </div>
                </div>
            </form>
            </div>
        </div>
        <div class="col-xl-3"></div>
    </div>

    @include('scripts.restoration')

</div>

@push('emergency-js')
<script>
    $('form').submit(function() {
        @this.set('building_id', $('#building').val());
    })
</script>
@endpush
