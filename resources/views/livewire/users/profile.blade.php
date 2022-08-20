<div>

    @section('title')
    Profile Update
    @endsection

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 col-xl-6">
            <div class="card mb-3">

                <div class="card-body text-center">

                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="alert-message">
                            <strong> {{ session('success') }}</strong>
                        </div>
                    </div>
                    @elseif (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="alert-message">
                            <strong> {{ session('error') }}</strong>
                        </div>
                    </div>
                    @endif



                    <img src="{{ auth()->user()->getAvatar() }}" class="img-fluid rounded-circle mb-2" alt="{{ auth()->user()->name }}" width="128" height="128">
                    <h5 class="card-title mb-0">{{ Auth::user()->name }}</h5>
                    <div class="text-muted mb-2">{{ Auth::user()->email }}</div>

                    <div>
                        <a class="btn btn-primary btn-sm" href="#" data-toggle="modal" wire:click.prevent="update">Update</a>
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
                <div class="col-md-3"></div>
            </div>




            <!-- sample modal content -->
            <div id="updateProfile" class="modal fade"  wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel">Update Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">

                            <div class="form-group row">
                                <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                                <div class="col-md-11 ml-3">
                                    <input type="text" class="form-control" value="{{ $user->name }}" name="name" placeholder="Name" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create-name" class="col-md-4 ml-3 col-form-label">Email</label>
                                <div class="col-md-11 ml-3">
                                    <input type="email" class="form-control" value="{{ $user->email }}" name="email" placeholder="email" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                                <div class="col-md-11 ml-3">
                                    <div class="input-group">
                                        <input type="{{ $showPassword == true ? 'text' : 'password' }}" class="form-control"  wire:model="password" placeholder="Password">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <a href="#" wire:click.prevent="{{ $showPassword == false ? 'toggleOn' : 'toggleOff' }}"><i class="align-middle mr-2 fas fa-fw fa-{{ $showPassword == false ? 'eye' : 'eye-slash' }}"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    @error('password')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                                <div class="col-md-11 ml-3">
                                    <input type="{{ $showPassword == true ? 'text' : 'password' }}" class="form-control" wire:model="password_confirmation" placeholder="Retype Password">
                                </div>
                                @error('password_confirmation')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                            <div class=" row">
                                <div class="col-md-8">
                                    <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Profile Pic</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="file" class="form-control" wire:model="image">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    @if ($image)
                                    <div>
                                        <img class="img-thumbnail rounded mr-2 mb-2" src="{{ $image->temporaryUrl() }}" alt="{{ auth()->user()->name }}" width="140" height="140">
                                    </div>
                                    @else
                                    <div>
                                        <img class="img-thumbnail rounded mr-2 mb-2" src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" width="140" height="140">
                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">

                            <div wire:loading wire:target="updateProfile" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Submitting . . .</div>
                            <div wire:loading wire:target="image" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Uploading . . .</div>

                            <div wire:loading.remove wire:target="image, updateProfile">
                                <a href="#" class="btn btn-dark waves-effect waves-light" wire:click.prevent="updateProfile('{{ $user->badge }}')">Submit</a>
                                <button type="button" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</button>
                            </div>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </div>
