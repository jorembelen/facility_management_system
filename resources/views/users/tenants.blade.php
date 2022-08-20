@extends('layouts.master')

@section('title', 'Tenants List')
@section('content')

<div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   </div>
                <div class="card-body">
                    <table id="datatables-reponsive" class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge Number</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($user as $data)
                                @if (auth()->user()->id != $data->id)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->badge }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->mobile }}</td>
                                {{-- <td class="text-center">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">Click</button>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="{{ route('users.edit', $data) }}"><i class="fas fa-fw fa-pencil-alt"></i> Update</a>
                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete{{ $data->id }}"><i class="fas fa-fw fa-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </td> --}}
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('occupants.create')

    @foreach ($user as $data)
    <!-- Modal -->
    <div class="modal fade" id="delete{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleStandardModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Delete this record?</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body m-3">
                <form class="form-horizontal" method="POST" action="{{ route('users.destroy', $data) }}">
                    @csrf
                    {{ method_field('DELETE') }}
                <h5 class="mb-0 text-center">If you delete the data it will be gone forever. Are you sure you want to proceed?</h5>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Yes</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
            </form>
            </div>
          </div>
        </div>
      </div>
@endforeach

@endsection
