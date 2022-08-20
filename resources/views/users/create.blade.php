

              <!-- sample modal content -->
                  <div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Add User</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">

                                    <form class="form-horizontal form-disabled-button"  method="POST" action="{{ route('users.store') }}" id="user-create">
                                        @csrf
                                        <div class="form-group row">
                                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="text" class="form-control" id="create-name" name="name" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Username</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="text" class="form-control" id="create-username" name="username" placeholder="username">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="create-name" class="col-md-4 ml-3 col-form-label">Role</label>
                                            <div class="col-md-11 ml-3">
                                                <select name="role" class="form-control select2">
                                                    <option value="">Select User Role</option>
                                                    <option value="staff">Staff</option>
                                                    <option value="scheduler">Scheduler</option>
                                                    <option value="supervisor">Supervisor</option>
                                                    <option value="representative">Representative</option>
                                                    <option value="assigner">Assigner</option>
                                                    <option value="admin">Admin</option>
                                                    {{-- <option value="super_admin">Super Admin</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="create-email" class="col-md-4 ml-3 col-form-label">Email</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="email" class="form-control" id="create-email" name="email" placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="create-password" class="col-md-4 ml-3 col-form-label">Password</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="password" class="form-control" id="create-password" name="password" placeholder="Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="create_confirm" class="col-md-4 ml-3 col-form-label">Confirm Password</label>
                                            <div class="col-md-11 ml-3">
                                                <input type="password" class="form-control" id="create_confirm" name="password_confirmation" placeholder="Retype Password">
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
