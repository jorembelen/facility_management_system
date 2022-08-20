<div class="form-row">
    <div class="form-group col-md-3 sm-3">
        <form action="{{ route('appointment.report') }}" method="get">
            <select name="work_category_id" id="category" class="form-control select2">

                <option value="">Select Work Category</option>
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-3 sm-3">
            <input type="text" id="datepicker" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="start date">
        </div>
        <div class="form-group col-md-3 sm-3">
            <input type="text" id="datepicker2" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="end date">
        </div>
        <div class="form-group col-md-3 sm-3">
            <select name="status" id="category" class="form-control">
                <option value="{{ request('status') }}">
                    @if (request('status') == 'false')
                    Open
                    @elseif (request('status') == 1)
                    Closed
                    @elseif (request('status') == 2)
                    Cancelled
                    @else
                    Select Status
                    @endif
                </option>
                <option value="false">Open</option>
                <option value="1">Closed</option>
                <option value="2">Cancelled</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="col-md-12 sm-12 text-right ">
            <button class="btn btn-primary"><i class="fas fa-fw fa-filter"></i> Filter</button>
            <a class="btn btn-success" href="{{ route('appointments.report') }}"><i class="fas fa-fw fa-redo"></i> Reset</a>
        </div>

    </div>
</form>



<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('datepicker'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    var f2 = flatpickr(document.getElementById('datepicker2'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
</script>
<script>
    function myFunction(){
        document.getElementById("category").value = "";
        document.getElementById("datepicker").value = "";
        document.getElementById("datepicker2").value = "";
    }
</script>
