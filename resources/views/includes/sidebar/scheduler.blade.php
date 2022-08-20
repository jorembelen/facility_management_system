
          @if(auth()->user()->role == 'scheduler')
          <li class="sidebar-item">
            <a href="#facilities" data-toggle="collapse" class="sidebar-link">
                <i class="align-middle" data-feather="home"></i> <span class="align-middle">Facilities</span>
            </a>
            <ul id="facilities" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['facilities', 'tenants-checkout', 'facilities-reports', 'occupied-facilities', 'vacant-facilities', 'facilities-restoration' ])) ? 'show' : '' }}" data-parent="#sidebar">
                <li class="sidebar-item {{ (request()->segment(1) == 'occupied-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.occupied') }}">Occupied Facilities</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'vacant-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.vacant') }}">Vacant Facilities</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'facilities-restoration') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('restoration') }}">Under Restoration</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'tenants-checkout') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenants.checkout') }}">Checked Out History</a></li>
                <li class="sidebar-item {{ (request()->segment(1) == 'facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.index') }}">Facilities List</a></li>
            </ul>
        </li>
          <li class="sidebar-item">
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
        <li class="sidebar-item {{ (request()->segment(1) == 'schedules-monitoring') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('sched-monitoring.index') }}">
                <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Schedule Monitoring</span>
            </a>
        </li>


        <li class="sidebar-item {{ (request()->segment(1) == 'scheduler-create') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('scheduler.create') }}">
                <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Create Appointment</span>
            </a>
        </li>
        <li class="sidebar-item {{ (request()->segment(1) == 'preventive-maintenance-list') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('prevMaint') }}">
                <i class="align-middle" data-feather="codepen"></i> <span class="align-middle">Preventive Maintenance</span>
            </a>
        </li>
        <li class="sidebar-item {{ (request()->segment(1) == 'restoration-list') ? 'active' : '' }}">
            <a class="sidebar-link" href="{{ route('restoration.list') }}">
                <i class="align-middle" data-feather="package"></i> <span class="align-middle">Restoration List</span>
            </a>
        </li>

        <li class="sidebar-item ">
            <a href="#reports" data-toggle="collapse" class="sidebar-link">
                <i class="align-middle" data-feather="trending-up"></i> <span class="align-middle">Reports</span>
            </a>
            <ul id="reports" class="sidebar-dropdown list-unstyled collapse {{ (request()->segment(1) == 'appointments-report') ? 'show' : '' }}" data-parent="#sidebar">
                <li class="sidebar-item {{ (request()->segment(1) == 'appointments-report') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.report') }}">Appointments</a></li>

                </ul>
            </li>

          @endif
