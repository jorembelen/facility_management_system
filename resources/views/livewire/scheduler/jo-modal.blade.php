
<!-- create modal content -->
<div id="createJo" class="modal fade" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Assign Technician {{ $appId }}</h3>
                <button type="button" class="close" wire:click.prevent="close">×</button>
            </div>
            <div class="modal-body">

                <form class="form-horizontal" wire:submit.prevent="submit">
                    <input type="hidden" wire:model.defer="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" wire:model.defer="client_appointment_id" value="{{ $jobOrder->id }}">

                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Select Technician</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <select wire:model="technicians" class="form-control select2" id="technicians" multiple>
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->badge }} - {{ $employee->name }}">{{ $employee->badge }} - {{ $employee->name }} ({{ $employee->designation }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('technicians')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @if ($schedules->count() > 0)
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="new_date" placeholder="select date">
                            </div>
                            @error('new_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-5 ml-3">
                            <label for="inputEmail4">Time Start</label>
                            <div wire:ignore>
                                <input type="text" class="form-control flatpickr flatpickr-input active" id="timeFlatpickr" wire:model.defer="time_start" placeholder="select end time">
                            </div>
                            @error('time_start')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5 ml-3">
                            <label for="inputPassword4">Time End</label>
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


                    @else
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="date" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                        <div class="col-md-11 ml-3">
                            <input type="text"  class="form-control" wire:model.defer="time" readonly>
                        </div>
                    </div>
                    @endif
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Notes</label>
                        <div class="col-md-11 ml-3">
                            <textarea wire:model.defer="notes" class="form-control" cols="30" rows="3"></textarea>
                            @error('notes')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="submit, close">
                        <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Update Job Order -->
<div class="modal fade" id="editJo" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-smile"></i> Update Appointment </h3>
                <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal" wire:submit.prevent="update('{{ $joId }}')">
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Technician Name</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <select wire:model="eTechnicians" class="form-control select2" id="eTechnicians" multiple>
                                    {{-- <option>{{ $eTechnicians }}</option> --}}
                                    @foreach ($employees as $employee)
                                    <option value="{{ $employee->badge }} - {{ $employee->name }}">{{ $employee->badge }} - {{ $employee->name }} ({{ $employee->designation }})</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('eTechnicians')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Date</label>
                        <div class="col-md-11 ml-3">
                            <div wire:ignore>
                                <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickrTwo" wire:model.defer="date" placeholder="select date">
                            </div>
                            @error('date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Time</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" value="{{ $time }}" class="form-control" wire:model.defer="time" >
                        </div>
                        @error('time')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Notes</label>
                        <div class="col-md-11 ml-3">
                            <textarea wire:model.defer="notes" class="form-control" cols="30" rows="3">{{ $notes }}</textarea>
                        </div>
                        @error('notes')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="update" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Updating . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="update, close">
                        <button  class="btn btn-dark waves-effect waves-light" type="submit">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Job Order -->
<div class="modal fade" id="deleteJo" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown"></i> Delete Appointment </h3>
                <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <h4>Are you sure? This data will be lost forever.</h4>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="remove" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Deleting . . .</div>
                <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove wire:target="remove, close">
                    <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="remove('{{ $joId }}')">Submit</button>
                    <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Close Appointment -->
<div class="modal fade" id="closeJo" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Close Job Order {{ $jobOrder->id }}</h3>
                <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">

                <h4 class="mb-0 text-center">Are you sure? If Yes please submit to proceed!</h4>
                <hr>
                <div class="form-group">
                    <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                    <input type="file" class="form-control"  wire:model="documents">
                    @error('documents')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="submitCloseJobOrder" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Closing . . .</div>
                <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove wire:target="submitCloseJobOrder, close">
                    <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submitCloseJobOrder('{{ $appId }}')">Submit</button>
                    <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="modal fade" id="closeRestoration" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-happy" style="color:red"></i> Close Job Order {{ $appId }}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <h4 class="mb-0 text-center">Are you sure? If Yes please submit to proceed!</h4>
                <hr>
                <div class="form-group">
                    <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                    <input type="file" class="form-control-file"  wire:model.defer="closing_attachment">
                    @error('closing_attachment')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="submitCloseRestoration" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Closing . . .</div>
                <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove wire:target="submitCloseRestoration, close">
                    <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submitCloseRestoration('{{ $appId }}')">Submit</button>
                    <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</div>



