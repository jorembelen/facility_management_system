<div>

    @section('title')
    Add Tenant
    @endsection

<div class="row">
    <div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3>Search from Staff Database</h3>
        </div>
        <div class="card-body">

            <div id="datatables-reponsive_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                {{-- <div class="row"><div class="col-sm-12 col-md-4">

                    </div>
                        <div class="col-sm-12 col-md-8">
                            <div id="datatables-reponsive_filter" class="dataTables_filter">
                                <label>Search :<input type="search"  wire:model="search" class="form-control " placeholder="search username or badge number" aria-controls="datatables-reponsive"></label>
                            </div></div></div> --}}
               <div class="row">
                <div class="col-md-9"></div>
                   <div class="col-md-3">
                    <div class="input-group input-group-navbar">
                        <input type="text" class="form-control text-center" wire:model="search" placeholder="Search username or badge number ..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn" type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search align-middle"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                            </button>
                        </div>
                    </div>
                   </div>
               </div>
            <div class="row"><div class="col-sm-12">
            <table class="table table-striped dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datatables-reponsive_info">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Badge</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Department Name</th>
                    <th>Division</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($searchResults as $data)
                        <tr>
                            <td>{{ $data['cn'][0] }}</td>
                            <td>{{ $data['employeeid'][0] }}</td>
                            <td>{{ $data['samaccountname'][0] }}</td>
                            <td>{{ $data['mail'][0] }}</td>
                            <td>{{ $data['mobile'][0] }}</td>
                            <td>{{ $data['department'][0] }}</td>
                            <td>{{ $data['division'][0] }}</td>
                            <td>
                                <form action="{{ route('add.tenant') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="name" value="{{ $data['cn'][0] }}">
                                    <input type="hidden" name="badge" value="{{ $data['employeeid'][0] }}">
                                    <input type="hidden" name="username" value="{{ $data['samaccountname'][0] }}">
                                    <input type="hidden" name="email" value="{{ $data['mail'][0] }}">
                                    <input type="hidden" name="mobile" value="{{ $data['mobile'][0] }}">
                                    <input type="hidden" name="division" value="{{ $data['division'][0] }}">
                                    <input type="hidden" name="guid" value="{{$data['objectguid'][0] }}">
                                    <input type="hidden" name="job_title" value="{{ $data['title'][0] }}">
                                    <input type="hidden" name="description" value="{{ $data['description'][0] }}">
                                    <input type="hidden" name="department_name" value="{{ $data['department'][0] }}">
                                    <input type="hidden" name="company" value="{{ $data['company'][0] }}">
                                    <input type="hidden" name="member_of" value="{{ $data['memberof'][0] }}">
                                    @php
                                    $user = \App\Models\User::whereusername($data['samaccountname'][0])->first();
                                    @endphp
                                    @if ($user)
                                    <button class="btn btn-primary btn-sm" type="button" disabled>Add</button>
                                    @else
                                    <button class="btn btn-primary btn-sm" type="submit">Add</button>
                                    @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                     <tr>
                        <td><h3 class="text-danger">  {{ $message }}</h3></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                     </tr>
               </tbody>
            </table>
        </div>
    </div>
</div>
</div>

</div>

@include('scripts.sweet-alert')
