<div>



                        <div class="main d-flex justify-content-center w-100">
                            <main class="content d-flex p-0">
                                <div class="container d-flex flex-column">
                                    <div class="row h-100">
                                        <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                                            <div class="d-table-cell align-middle">

                                                <div class="text-center mt-4">
                                                    <h1 class="h2">Reset password</h1>
                                                    <p class="lead">
                                                        To preserve confidentiality of your account, Please reset your password.
                                                    </p>
                                                </div>

                                                <div class="card">
                                                    <div class="card-body">
                                                        <form wire:submit.prevent="resetPassword">
                                                            <div class="form-group">
                                                                <div class="input-group date">
                                                                    <input type="{{ $showPassword == false ? 'password' : 'text' }}" class="form-control form-control-lg" wire:model.defer="password" placeholder="Enter your password">
                                                                    <div class="input-group-append">
                                                                        <div class="input-group-text">
                                                                          <a href="#" wire:click.prevent="{{ $showPassword == false ? 'show' : 'hide' }}">  <i class="fa fa-eye{{ $showPassword == false ? '-slash' : null }}"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @error('password')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                 <input class="form-control form-control-lg" type="{{ $showPassword == false ? 'password' : 'text' }}" wire:model.defer="new_confirm_password" placeholder="Confirm your password" />
                                                               @error('new_confirm_password')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                            <div class="text-center mt-3">
                                                                <button type="submit" class="btn btn-lg btn-primary" wire:click.prevent="resetPassword">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </main>
                        </div>

</div>
