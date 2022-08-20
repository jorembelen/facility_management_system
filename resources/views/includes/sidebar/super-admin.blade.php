
          @if(auth()->user()->role == 'super_admin')

          <li class="sidebar-item {{ (in_array(request()->segment(1), ['work-categories', 'category-options', 'schedules', 'tenants', 'employees-list', 'tenants', 'new-tenant', 'users-list'])) ? 'active' : '' }}">
            <a href="#pages" data-toggle="collapse" class="sidebar-link">
                <i class="align-middle" data-feather="layers"></i> <span class="align-middle">System Management</span>
            </a>
            <ul id="pages" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['work-categories', 'category-options', 'schedules', 'tenants', 'employees-list', 'tenants', 'new-tenant', 'users-list'])) ? 'show' : '' }}" data-parent="#sidebar">

                <li class="sidebar-item {{ (request()->segment(1) == 'work-categories') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('work-categories.index') }}">Work Categories</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'category-options') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('category-options.index') }}">Work Category Options</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'schedules') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('schedules.index') }}">Schedules</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'employees-list') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('employees') }}">Employees</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'users-list') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('users') }}">Users</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'tenants') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenants.index') }}">Tenants List</a></li>
            </ul>
        </li>

            <li class="sidebar-item {{ (in_array(request()->segment(1), ['facilities', 'tenants-checkout', 'facilities-reports', 'occupied-facilities', 'vacant-facilities', 'facilities-restoration' ])) ? 'active' : '' }}">
                <a href="#facilities" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="home"></i> <span class="align-middle">Facilities</span>
                </a>
                <ul id="facilities" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['facilities', 'tenants-checkout', 'facilities-reports', 'occupied-facilities', 'vacant-facilities', 'facilities-restoration' ])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'occupied-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.occupied') }}">Occupied</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'vacant-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.vacant') }}">Vacant</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'facilities-restoration') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('restoration') }}">Under Restoration</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'tenants-checkout') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenants.checkout') }}">Checked Out History</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.index') }}">All Facilities</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ (in_array(request()->segment(1), ['open-appointments', 'closed-appointments' , 'cancelled-appointments' , 'appointments'])) ? 'active' : '' }}">
                <a href="#appointments" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Appointments</span>
                </a>
                <ul id="appointments" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['open-appointments', 'closed-appointments' , 'cancelled-appointments' , 'appointments'])) ? 'show' : '' }}" data-parent="#sidebar">
                    <li class="sidebar-item {{ (request()->segment(1) == 'open-appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.open') }}">Open</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'closed-appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.closed') }}">Closed</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'cancelled-appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.cancelled') }}">Cancelled</a></li>
                    <li class="sidebar-item {{ (request()->segment(1) == 'appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.index') }}">All</a></li>
                </ul>
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == 'calendar') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('calendar') }}">
                    <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == 'occupancies-assigned') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('occupancies.assigned') }}">
                    <i class="fa fa-user-check"></i>Newly Assigned <span class="badge badge-sidebar-primary"><x-span assigned /></span>
                </a>
            </li>
            <li class="sidebar-item {{ (request()->segment(1) == 'checkout-request') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('checkout.request') }}">
                    <i class="fa fa-user-times"></i>Checkout Request <x-checkout total />
                </a>
            </li>

            <li class="sidebar-item {{ (in_array(request()->segment(1), ['appointments-report', 'checkin-reports', 'checkout-reports'])) ? 'active' : '' }}">
                <a href="#reports" data-toggle="collapse" class="sidebar-link">
                    <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Reports</span>
                </a>
                <ul id="reports" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['appointments-report', 'checkin-reports', 'checkout-reports'])) ? 'show' : '' }}" data-parent="#sidebar">
                        <li class="sidebar-item {{ (request()->segment(1) == 'appointments-report') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.report') }}">Appointments</a></li>
                        <li class="sidebar-item {{ (request()->segment(1) == 'checkin-reports') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('checkins.report') }}">Checkin</a></li>
                        <li class="sidebar-item {{ (request()->segment(1) == 'checkout-reports') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('checkouts.report') }}">Checkout</a></li>

                    </ul>
                </li>

          <li class="sidebar-item">
              <a href="#imports" data-toggle="collapse" class="sidebar-link">
                  <i class="align-middle" data-feather="upload"></i> <span class="align-middle">Uploads</span>
              </a>
              <ul id="imports" class="sidebar-dropdown list-unstyled collapse {{ ( in_array(request()->segment(1), ['users-import' , 'buildings-import',
              'occupancies-import-index' , 'schedules-import' , 'employees-import', 'category-options-import', 'maintenance-location-import'])) ? 'show' : '' }}" data-parent="#sidebar">
                  {{-- <li class="sidebar-item {{ (request()->segment(1) == 'users-import') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('users-import.index') }}">Import Users</a></li> --}}
                  {{-- <li class="sidebar-item {{ (request()->segment(1) == 'buildings-import') ? 'active' : '' }}"><a class="sidebar-link" href="buildings-import">Import Facilities</a></li>
                  <li class="sidebar-item {{ (request()->segment(1) == 'occupancies-import-index') ? 'active' : '' }}"><a class="sidebar-link" href="occupancies-import-index">Import Occupancies</a></li> --}}
                  <li class="sidebar-item {{ (request()->segment(1) == 'schedules-import') ? 'active' : '' }}"><a class="sidebar-link" href="schedules-import">Import Schedules</a></li>
                  {{-- <li class="sidebar-item {{ (request()->segment(1) == 'employees-import') ? 'active' : '' }}"><a class="sidebar-link" href="employees-import">Import Employees</a></li>
                  <li class="sidebar-item {{ (request()->segment(1) == 'maintenance-location-import') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('maint-import') }}">Import Work Location</a></li>
                  <li class="sidebar-item {{ (request()->segment(1) == 'category-options-import') ? 'active' : '' }}"><a class="sidebar-link" href="category-options-import">Import Category Options</a></li> --}}
              </ul>
          </li>
          <li class="sidebar-item {{ (request()->segment(1) == 'schedules-remove') ? 'active' : '' }}">
              <a href="#maintenance" data-toggle="collapse" class="sidebar-link">
                  <i class="align-middle" data-feather="aperture"></i> <span class="align-middle">Maintenance</span>
              </a>
              <ul id="maintenance" class="sidebar-dropdown list-unstyled collapse {{ (request()->segment(1) == 'schedules-remove') ? 'show' : '' }}" data-parent="#sidebar">
                  <li class="sidebar-item {{ (request()->segment(1) == 'schedules-remove') ? 'active' : '' }}"><a class="sidebar-link" href="schedules-remove">Delete Schedules</a></li>
              </ul>
          </li>
          <li class="sidebar-item {{ (request()->segment(1) == 'transaction-logs') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('logs') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                Transaction Logs</span>
            </a>
        </li>
          <li class="sidebar-item {{ (request()->segment(1) == 'sessions-list') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('sessions.list') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users align-middle"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                User Session</span>
            </a>
        </li>
          @endif
