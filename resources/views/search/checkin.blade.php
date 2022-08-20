<div class="form-row">
    <div class="col-md-2 sm-2">
            <form action="{{ route('checkin.report') }}" method="get">
    </div>
    <div class="form-group col-md-3 sm-3">
        <input type="text" id="datepicker" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="start date">
    </div>
    <div class="form-group col-md-3 sm-3">
        <input type="text" id="datepicker2" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="end date">
    </div>
    <div class="form-group col-md-3 sm-3">
        <button class="btn btn-primary"><i class="fas fa-fw fa-filter"></i> Filter</button>
        <a class="btn btn-success" href="{{ route('checkins.report') }}"><i class="fas fa-fw fa-redo"></i> Reset</a>

    </div>
</form>
</div>

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
       document.getElementById("datepicker").value = "";
       document.getElementById("datepicker2").value = "";
    }
    </script>
