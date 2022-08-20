<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/">
            <h2 class="align-middle mr-3 text-light">FMS|APP</h2></a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Navigate {{ auth()->user()->isTenant() ? 'التنقل' : null }}
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == '') ? 'active' : '' }}">
                <a class="sidebar-link" href="/">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid align-middle mr-2"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    Dashboard {{ auth()->user()->isTenant() ? 'ألغيت' : null }} </span>
                </a>
            </li>



            {{-- For Super Admin --}}
                 @include('includes.sidebar.super-admin')

            {{-- For Admin --}}
                 @include('includes.sidebar.admin')

            {{-- For Super Supervisor --}}
                 @include('includes.sidebar.supervisor')

            {{-- For Tenant --}}
                 @include('includes.sidebar.tenant')



            {{-- For Sadara Representative --}}
                 @include('includes.sidebar.representative')

            {{-- For Sadara assigner --}}
                 @include('includes.sidebar.assigner')

            {{-- For RCL Scheduler --}}
                @include('includes.sidebar.scheduler')


            <li class="sidebar-item {{ (request()->segment(1) == 'help') ? 'active' : '' }}">
                <a class="sidebar-link" href="/help">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle align-middle mr-2"><circle cx="12" cy="12" r="10"></circle><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
                    Help {{ auth()->user()->isTenant() ? 'مساعدة' : null }} </span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out align-middle mr-2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                    Logout {{ auth()->user()->isTenant() ? 'تسجيل خروج' : null }} </span>
                    {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form> --}}
                </a>
            </li>
    </div>
</nav>
