<form action="{{ route('schedules.index') }}" method="get">
<div class="form-row">
    <div class="form-group col-md-3 col-sm-6">
            <select name="work_category_id" id="category" class="form-control select2">
                @if ($categoriesName)
                <option value="{{ request('work_category_id') }}">{{ $categoriesName }}</option>
                @else
                <option value="">Select Work Category</option>
                @endif
                @foreach ($categories as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
            </select>
    </div>
    <div class="form-group col-md-3 col-sm-6">
        <input type="text" id="datepicker" name="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>
    <div class="form-group col-md-3 col-sm-6">
        <input type="text" id="datepicker2" name="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>
    <div class="form-group col-md-3 col-sm-6">
        <button class="btn btn-primary"><i class="fas fa-fw fa-filter"></i> </button>
        <button type="submit" class="btn btn-success" id="reset-button3" onclick="myFunction()"><i class="fas fa-fw fa-redo"></i> </button>
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
