@section('title', 'Update Appointment')
<div>
    <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Update {{ $appointment->id }}</h2>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" wire:submit.prevent="updateAppointment('{{ $buildingId }}')" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="form-label">Work Category</label>
                            <h3>{{ $appointment->category->name }}</h3>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <h3>{{ date('M-d-Y', strtotime($appointment->date)) }}</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Scheduled Time</label>
                            <h3>{{ $appointment->schedule_time }}</h3>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Complain</label>
                            <div wire:ignore>
                                <select wire:model="job_description" class="form-control" id="description">
                                    <option value="{{ $job_description }}">{{ $job_description }}</option>
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
                            <textarea wire:model="other_description" class="form-control"  placeholder="Please provide other description"></textarea>
                            @error('other_description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Location</label>
                            <div wire:ignore>
                                <select wire:model="job_location" class="form-control select2" id="location" multiple>
                                    @foreach ($locations as $loc)
                                    <option value="{{ $loc->location }}">{{ $loc->location }}</option>
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
                            <label class="form-label">Image(s)</label>
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
                                    <img src="{{ $image->temporaryUrl() }}" class="card-img-top" alt="Unsplash" >
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="row mt-4">
                                @foreach ($oldImages as $photo)
                                <div class="col-6 col-md-4 col-lg-4 col-xl-3 mt-2">
                                    <img src="{{ Storage::disk('s3')->url('uploads/images/'.$photo ) }}" class="card-img-top" alt="{{ $photo }}" >
                                </div>
                                @endforeach
                            </div>
                            @endif
                            @if ($hasImages)
                                <label class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="removeImages">
                                    <span class="form-check-label">
                                        {{ count($oldImages) > 1 ? 'Remove Images' : 'Remove Image' }}
                                    </span>
                                </label>
                            @endif
                        </div>
                        <div class="form-group">
                            <div wire:ignore>
                                <label for="docs" class="form-label w-100"><strong>Attached Documents (pdf) المستندات المرفقة (pdf)</strong><span class="text-danger"> </span></label>
                                <input type="file" wire:model.defer="documents">
                            </div>
                            @error('documents')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            @if ($documents)
                                @if ($documents->getClientOriginalExtension() === 'pdf')
                                <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3 mt-2 img-wrap">
                                    <a href="#" wire:click.prevent="remove"><span class="close">&times;</span></a>
                                    <img src="{{ asset('assets/img/pdf.png') }}" class="card-img-top" alt="attach document" >
                                </div>
                                @else
                                <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3 mt-2 img-wrap">
                                    <a href="#" wire:click.prevent="remove"><span class="close">&times;</span></a>
                                    <img src="{{ asset('assets/img/no-image.png') }}" class="card-img-top" alt="Unsplash" >
                                </div>
                                @endif
                            @else
                                @if ($hasDocs)
                                <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3 mt-2 img-wrap">
                                    <img src="{{ asset('assets/img/pdf.png') }}" class="card-img-top" alt="attach document" >
                                </div>
                                <label class="form-check mt-2">
                                    <input class="form-check-input" type="checkbox" value="1" wire:model="removeDocument">
                                    <span class="form-check-label">
                                        Remove Attach Document
                                    </span>
                                </label>
                                @endif
                            @endif

                        </div>
                        <div class="modal-footer">
                            <div wire:loading wire:target="updateAppointment" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                            <div wire:loading wire:target="images" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading . . .</div>


                            <div wire:loading.remove wire:target="updateAppointment, images">
                                <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit </button>
                                <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('scripts.client_appointment')

</div>

@push('appointment-js')
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#location').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('job_description', $('#description').val());
        @this.set('job_location', $('#location').val());
    })
</script>
<script>
    $(document).ready(function() {
        $('#location').select2();
    });
</script>
@endpush
