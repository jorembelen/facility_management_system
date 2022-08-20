@section('title')
Logs
@endsection

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body table-responsive" >
                    <table id="datatables"  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Transactions</th>
                                <th>Transaction Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $log->log_info }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

@push('users-js')

<script>
    document.addEventListener('livewire:load', function () {
        $('#datatables').DataTable();
    });
</script>

@endpush
