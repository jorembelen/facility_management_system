@section('title', 'Create Appointment إنشاء موعد')
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
        .btn:focus {
            outline: none;
            box-shadow: none;
        }
    </style>

    <div class="row">
        <div class="col-xl-1"></div>
        <div class="col-xl-10">
            <div class="card">

                <div class="card-header">
                    <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route( 'appointment.index') }}"
                        type="button"class="btn btn-dark mb-2 float-right">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-corner-up-left"><polyline points="9 14 4 9 9 4"></polyline><path d="M20 20v-7a4 4 0 0 0-4-4H4"></path></svg>
                        Back خلف
                    </a>
                </div>

                @if ($selectScheduleShow)
                <div class="card-body" >
                    <div class="alert alert-primary alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="alert-icon">
                            <i class="far fa-fw fa-bell"></i>
                        </div>
                        <div class="alert-message">
                            <strong>Please select work category and date to proceed! الرجاء تحديد فئة العمل والتاريخ للمتابعة!</strong>
                        </div>
                    </div>
                    <form wire:submit.prevent="getSchedule">
                        <div wire:loading.remove wire:target="getSchedule">
                            <div class="form-group">
                                <label class="form-label">Work Category فئة العمل</label>
                                <div class="row">
                                    <div class="col-11 col-sm-10">
                                        <div>
                                            <select wire:model="category" class="form-control">
                                                <option>Choose Work Category اختر فئة العمل</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }} {{ $category->arabic ? '( ' .$category->arabic .' )' : null  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-1 col-sm-2">
                                        <a href="#" wire:click.prevent="help({{ $category }})" data-toggle="tooltip" data-placement="top" title="" data-original-title="Click to view category information">
                                            <img src="{{ asset('assets/img/help.png') }}" alt="help" width="30">
                                        </a>
                                    </div>
                                </div>
                                @error('category')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="form-label">Date تاريخ</label>
                                <div wire:ignore>
                                    <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="date" placeholder="choose date اختر موعدا">
                                </div>@error('date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div >
                                <a href="#"  class="btn btn-primary waves-effect waves-light" wire:click.prevent="getSchedule">Check Schedule تحقق من الجدول</a>
                            </div>
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
                            <label class="form-label">Work Category فئة العمل</label>
                            <h3>{{ $workCategory->name }} {{ $workCategory->arabic }}</h3>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Date تاريخ</label>
                            <h3>{{ date('M-d-Y', strtotime($date)) }}</h3>
                        </div>
                        <hr>
                        <div class="form-group">

                            <h4>Select Appointment Time حدد وقت الموعد</h4>
                            <div>
                                <div class="card bg-light  border">
                                    <div class="card-body">
                                        @foreach ($schedules as $item)
                                        <label class="form-check form-check-inline mr-4">
                                            <input class="form-check-input" type="radio" value="{{ $item->time }}" wire:model.defer="schedule_time" name="radios-example" {{ $item->slot <= 0 ? 'disabled' : 'checked' }}>
                                            <span class="form-check-label">
                                                {{ $item->time }}
                                            </span>
                                        </label>
                                        @endforeach
                                        @error('schedule_time')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><strong>Issue / Complaint المشكلة / الشكوى</strong></label>
                            <div wire:ignore>
                                <select wire:model="job_description" class="form-control" id="appointment_frm">
                                    <option value="">Choose ... يختار</option>
                                    @foreach ($options as $option)
                                    <option value="{{ $option->name }}">{{ $option->name }} {{ $option->arabic }}</option>
                                    @endforeach
                                    <option value="Others">Others أخرى</option>
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
                            <label class="form-label"><strong>Location موقع</strong></label>
                            <div wire:ignore>
                                <select wire:change="$emit('classChanged', $event.target.value)" class="form-control location" id="location" multiple>
                                    @foreach ($locations as $item)
                                    <option value="{{ $item->location }}">{{ $item->location }} {{ $item->arabic }}</option>
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
                            <input type="file"  wire:model="images" id="img{{ $iteration }}"  multiple>

                            @error('images.*')
                            <div class="text-danger ">
                                {{ $message }}
                            </div>
                            @enderror
                            @if ($images)
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
                                <input type="file" wire:model.defer="documents" id="doc{{ $iteration }}">
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
                            @endif
                        </div>

                        <div class="modal-footer">
                            <div wire:loading wire:target="createAppointment" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Processing . . .</div>
                            <div wire:loading wire:target="images" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading Images . . .</div>
                            <div wire:loading wire:target="documents" class="progress-bar progress-bar-striped progress-bar-animated mt-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading Document . . .</div>

                            <div wire:loading.remove wire:target="createAppointment, images, documents">
                                <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit يُقدِّم</button>
                                <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route( 'appointment.index') }}" type="button" class="btn btn-danger waves-effect">Cancel يلغي</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endif

            </div>
        </div>
    </div>

    @include('scripts.client_appointment')

    @if ($showHelp)
    <!-- Help modal content -->
    <div id="helpModal" class="modal fade" wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"> {{ $categoryName }} {{ $categoryNameArabic  }}</h4>
                    <button type="button" class="close" wire:click.prevent="close">×</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Issue / Complaint المشكله / الشكوى</th>
                                        <th>مخاوف</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $item)
                                    <tr>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->arabic ?? null }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    @endif

</div>

@push('create-js')
<script src="{{ asset('assets/plugins/flatpickr/flatpickr.js') }}"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(2) // 14 days from now
    });

</script>
<script>
    $(document).ready(function () {
        window.addEventListener('reApplySelect2', event => {
            $('#location').select2();
        });
    });
</script>
<script>
    $('form').submit(function() {
        @this.set('job_location', $('#location').val());
    })
</script>
<script>
    window.addEventListener('show-help-modal', function (event) {
        $('#helpModal').modal('show');
    });
    window.addEventListener('hide-modal', function (event) {
        $('#helpModal').modal('hide');
    });
</script>
@endpush



