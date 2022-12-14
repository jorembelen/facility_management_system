@extends('layouts.master')

@section('title', 'Update User')
@section('content')

<div class="row">
    <div class="col-3"></div>
<div class="col-xl-6">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('users.update', $user) }}" id="user-update">
                @csrf
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Badge Number</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" name="badge" value="{{ $user->badge }}" placeholder="Badge">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Name</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" placeholder="Name">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Username</label>
                    <div class="col-md-8 mt-1">
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" placeholder="Username">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Role</label>
                    <div class="col-md-8 mt-1">
                        @if ($user->role != 'tenant')
                        <select name="role" class="form-control select2">
                            <option value="{{ $user->role }}">{{ $user->role }}</option>
                            <option value="scheduler">Scheduler</option>
                            <option value="supervisor">Supervisor</option>
                            <option value="representative">Representative</option>
                            <option value="assigner">Assigner</option>
                            <option value="admin">Admin</option>
                            <option value="super_admin">Super Admin</option>
                        </select>
                        @else
                        <input type="text" value="{{ $user->role }}" class="form-control" readonly>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-md-3 mt-1 ml-1 col-form-label">Status</label>
                    <div class="col-md-8 mt-1">
                        <select name="status" class="form-control select2">
                            <option value="{{ $user->status }}">
                                @if ($user->status == 0)
                                   Inactive
                                @else
                                    Active
                                @endif
                            </option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-md-3 mt-1 ml-1 col-form-label">Email</label>
                    <div class="col-md-8 mt-1">
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" placeholder="Email">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-md-3 mt-1 ml-1 col-form-label">Password</label>
                    <div class="col-md-8 mt-1">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm" class="col-md-3 mt-1 ml-1 col-form-label">Confirm Password</label>
                    <div class="col-md-8 mt-1">
                        <input type="password" class="form-control" id="confirm" name="password_confirmation" placeholder="Retype Password">
                    </div>
                </div>

                </div>
                <div class="modal-footer">
                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <a href="{{ \URL::previous() }}" type="button" class="btn btn-danger waves-effect disabled-button-prevent">Cancel</a>
                </form>
        </div>
    </div>
</div>
<div class="col-3"></div>
</div>
@endsection
