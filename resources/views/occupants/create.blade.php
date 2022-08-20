           <!-- sample modal content -->
           <div id="create" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="myModalLabel"><i class="fas fa-fw fa-user-plus"></i> Add Tenant</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    </div>
                    <div class="modal-body">

                            <form class="form-horizontal form-disabled-button" method="POST" action="{{ route('tenant.create') }}" id="occ-create">
                                @csrf
                                <input type="hidden" name="category" value="product">
                                <div class="form-group row">
                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Badge</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="text" class="form-control" name="badge" placeholder="badge">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Name</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="text" class="form-control" name="name" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Email</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="email" class="form-control" name="email" placeholder="email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="create-name" class="col-md-4 ml-3 col-form-label">Mobile Number</label>
                                    <div class="col-md-11 ml-3">
                                        <input type="text" class="form-control" name="mobile" placeholder="mobile number">
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