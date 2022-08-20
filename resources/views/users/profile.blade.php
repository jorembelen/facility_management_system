
@extends('layouts.master')

@section('title', 'Update Profile')
@section('content')

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Details</h5>
            </div>
            <div class="card-body text-center">

                <img src="{{ auth()->user()->getAvatar() }}" class="img-fluid rounded-circle mb-2" alt="{{ auth()->user()->name }}" width="128" height="128">
                <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
                <div class="text-muted mb-2">{{ Auth::user()->email }}</div>

                <div>
                    <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" data-target="#profile{{ $users->id }}">Update</a>
                 </div>
            </div>

            <hr class="my-0">
            <div class="card-body">
                <h5 class="h6 card-title">Username</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock align-middle mr-2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        {{ Auth::user()->username }}

                </ul>
            </div>
            <hr class="my-0">
            <div class="card-body">
                <h5 class="h6 card-title">Role</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1">

                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user align-middle mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    {{ Str::upper(Auth::user()->role) }}
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-4"></div>
</div>




     <!-- sample modal content -->
     <div id="profile{{ $users->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Update Profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">

                        <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('profile.update', $users->id) }}" id="profile-update" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group row">
                                <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                                <div class="col-md-11 ml-3">
                                    <input type="text" class="form-control" value="{{ $users->name }}" name="name" placeholder="Name" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create-name" class="col-md-4 ml-3 col-form-label">Email</label>
                                <div class="col-md-11 ml-3">
                                    <input type="email" class="form-control" value="{{ $users->email }}" name="email" placeholder="email" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                                <div class="col-md-11 ml-3">
                                    <input type="password" class="form-control"  name="password" placeholder="Password" id="myInput">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                                <div class="col-md-11 ml-3">
                                    <input type="password" class="form-control" name="password_confirmation" placeholder="Retype Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-11 ml-3">
                                    <label class="form-check form-check-inline float-right">
                                        <input class="form-check-input" type="checkbox" onclick="myFunction()">
                                        <span class="form-check-label">Show Password</span>
                                      </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Profile Pic</label>
                                <div class="col-md-11 ml-3">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>

                </div>
                <div class="modal-footer">

                    <div class="progress-bar progress-bar-striped progress-bar-animated spinner-prevent" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                    <button type="submit" class="btn btn-dark waves-effect waves-light disabled-button-prevent">Submit</button>
                    <button type="button" class="btn btn-danger waves-effect disabled-button-prevent" data-dismiss="modal">Close</button>

                </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <script>
        function myFunction() {
      var x = document.getElementById("myInput");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
    </script>
    @endsection
