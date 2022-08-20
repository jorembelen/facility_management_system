@section('title', 'Upgraded Checkout')

<div>

    <div class="row">
        <div class="col-12">
        <div class="card">

            <div class="card-body">

                <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Badge No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Facilities Info</th>
                            <th>Request Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($checkout as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tenant->badge }}</td>
                                <td>{{ $item->tenant->name }}</td>
                                <td>{{ $item->tenant->email }}</td>
                                <td>{{ $item->tenant->mobile }}</td>
                                <td>
                                    {{ $item->block_no ? $item->buildingInfo() : $item->street .' (' .$item->type->name .')' }}
                                </td>
                                <td>{{ date('M-d-Y', strtotime($item->updated_at)) }}</td>
                                <td>
                                    @if (auth()->user()->role == 'supervisor')
                                    <a href="#" wire:click.prevent="approveShow('{{$item->tenant->badge}}')"><span class="badge badge-success">Checkout</span></a>
                                    @endif
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <!-- Checkout Tenant Modal -->
        <div class="modal fade" id="reqCheckout" wire:ignore.self>
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Checks Out Tenant?</h3>
                  <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body m-3">

                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label class="form-label">Checkout Date</label>
                            <div wire:ignore>
                                <input type="text" class="form-control flatpickr flatpickr-input active" id="dateTimeFlatpickr" wire:model.defer="checkout_date" placeholder="select date">
                            </div>
                            @error('checkout_date')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>


                    </div>

                    <div class="form-group">
                        <label for="docs">Attached Documents (word/excel/pdf)<span class="text-danger"> </span></label>
                        <input type="file" class="form-control-file"  wire:model.defer="attachment">
                        @error('attachment')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="submit" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="submit. close">
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submit('{{ $buildingId }}')">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

</div>


<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });

    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var f2 = flatpickr(document.getElementById('timeFlatpickr'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: time
    });

</script>
