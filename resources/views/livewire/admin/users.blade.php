@section('title', 'Users')

<div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a class="btn btn-primary float-right" wire:click.prevent="create"><i class="fas fa-plus-circle"></i> Add</a>
                </div>

                <div class="card-body table-responsive">

                    @include('search.table-search')

                    <table  class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Badge</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Role</th>
                                @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <th>Status</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $data)
                            @if (auth()->user()->id != $data->id)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->badge }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->mobile }}</td>
                                <td><span class="badge badge-info">{{ Str::upper($data->role) }}</span></td>
                                @if (in_array(auth()->user()->role, ['admin', 'super_admin']))
                                <td>
                                    <a href="#" wire:click.prevent="{{ $data->status === 1 ? 'deactivate' : 'activate' }}('{{ $data->badge }}')">
                                        <span class="badge badge-pills badge-{{ $data->status === 1 ? 'primary' : 'danger' }}">{{ $data->status === 1 ? 'Active' : 'Inactive' }}</span>
                                    </a>
                                </td>
                                @endif
                                <td class="table-action">
                                    <a href="#" wire:click.prevent="editShow('{{ $data->badge }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 align-middle"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a>
                                    <a href="#" wire:click.prevent="deleteConfirm('{{ $data->badge }}')"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash align-middle"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Create modal content -->
    <div id="createStaff" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Add Staff</h4>
                    <button type="button" class="close" wire:click.prevent="close">??</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="name" placeholder="Name">
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Badge Number</label>
                        <div class="col-md-11 ml-3">
                            <input type="number" class="form-control" wire:model.defer="badge" placeholder="badge number">
                            @error('badge')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Username</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="username" placeholder="username">
                            @error('username')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Role</label>
                        <div class="col-md-11 ml-3">
                            <select wire:model.defer="role" class="form-control">
                                <option value="">Select User Role</option>
                                <option value="staff">Staff</option>
                                <option value="scheduler">Scheduler</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="representative">Representative</option>
                                <option value="assigner">Assigner</option>
                                <option value="admin">Admin</option>
                            </select>
                            @error('role')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Mobile</label>
                        <div class="col-md-11 ml-3">
                            <input type="number" class="form-control" wire:model.defer="mobile" placeholder="mobile number">
                            @error('mobile')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                        <div class="col-md-11 ml-3">
                            <input type="email" class="form-control" wire:model.defer="email" placeholder="Email">
                            @error('email')
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
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="submit">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
    <!-- Create modal content -->
    <div id="EditStaff" class="modal fade" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Update {{ $name }}</h4>
                    <button type="button" class="close" wire:click.prevent="close">??</button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="name" placeholder="Name">
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Badge Number</label>
                        <div class="col-md-11 ml-3">
                            <input type="number" class="form-control" wire:model.defer="badge" placeholder="badge number">
                            @error('badge')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Username</label>
                        <div class="col-md-11 ml-3">
                            <input type="text" class="form-control" wire:model.defer="username" placeholder="username">
                            @error('username')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Role</label>
                        <div class="col-md-11 ml-3">
                            <select wire:model.defer="role" class="form-control">
                                <option value="{{ $role }}">{{ Str::ucfirst($role) }}</option>
                                @if ($role != 'tenant')
                                <option value="staff">Staff</option>
                                <option value="scheduler">Scheduler</option>
                                <option value="supervisor">Supervisor</option>
                                <option value="representative">Representative</option>
                                <option value="assigner">Assigner</option>
                                <option value="admin">Admin</option>
                                @endif
                            </select>
                            @error('role')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="create-name" class="col-md-4 ml-3 col-form-label">Mobile</label>
                        <div class="col-md-11 ml-3">
                            <input type="number" class="form-control" wire:model.defer="mobile" placeholder="mobile number">
                            @error('mobile')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                        <div class="col-md-11 ml-3">
                            <input type="email" class="form-control" wire:model.defer="email" placeholder="Email">
                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ml-3">
                        <a href="#" wire:click.prevent="updatePass"><span class="badge badge-{{ $updatePassword ? 'danger' : 'primary' }}">{{ $updatePassword ? 'Hide Password' : 'Update Password' }}</span></a>
                    </div>
                    @if ($updatePassword)
                    <div class="form-group row">
                        <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                        <div class="col-md-11 ml-3">
                            <input type="password" class="form-control" wire:model="password" placeholder="Password">
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
                            <input type="password" class="form-control" wire:model="password_confirmation" placeholder="Retype Password">
                        </div>
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="update" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Updating . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="update, close">
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="update('{{ $badge }}')">Update</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteStaff">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown"></i> Delete {{ $userName }}?</h3>
                    <button type="button" class="close" wire:click.prevent="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <h5 class="mb-0 text-center">If you delete the data it will be gone forever. Are you sure you want to proceed?</h5>
                </div>
                <div class="modal-footer">
                    <div wire:loading wire:target="delete" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Deleting . . .</div>
                    <div wire:loading wire:target="close" class="progress-bar progress-bar-striped progress-bar-animated mb-2" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                    <div wire:loading.remove wire:target="delete, close">
                        <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="delete('{{ $userId }}')">Submit</button>
                        <a href="#" class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</a>
                    </div>
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
    window.addEventListener('hide-form', function (event) {
        $('#responsive').DataTable();
    });
</script>

@endpush
