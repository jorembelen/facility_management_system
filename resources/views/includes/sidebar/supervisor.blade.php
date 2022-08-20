
@if(auth()->user()->role == 'supervisor')
<li class="sidebar-item {{ (in_array(request()->segment(1), ['category-options', 'schedules'])) ? 'active' : '' }}">
    <a href="#pages" data-toggle="collapse" class="sidebar-link">
        <i class="align-middle" data-feather="layers"></i> <span class="align-middle">System Management</span>
    </a>
    <ul id="pages" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['category-options', 'schedules'])) ? 'show' : '' }}" data-parent="#sidebar">
        <li class="sidebar-item {{ (request()->segment(1) == 'category-options') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('category-options.index') }}">Work Category Options</a></li>
        <li class="sidebar-item {{ (request()->segment(1) == 'schedules') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('schedules.index') }}">Schedules</a></li>
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
<li class="sidebar-item {{ (request()->segment(1) == 'supervisor-appointment-create') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('supervisor.create') }}">
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
<li class="sidebar-item {{ (request()->segment(1) == 'calendar') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('calendar') }}">
        <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Calendar</span>
    </a>
</li>
<li class="sidebar-item {{ (request()->segment(1) == 'occupancies-assigned') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('occupancies.assigned') }}">
        <i class="fa fa-user-plus"></i>Newly Assigned <span class="badge badge-sidebar-primary"><x-span assigned /></span>
    </a>
</li>
<li class="sidebar-item {{ (request()->segment(1) == 'checkout-request') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('checkout.request') }}">
        <i class="fa fa-user-times"></i>Checkout Request <x-checkout total />
    </a>
</li>
<li class="sidebar-item {{ (request()->segment(1) == 'checkout-upgraded-account') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('upgraded.checkout') }}">
        <i class="fa fa-user-slash"></i>Upgraded Checkout <x-upgraded-checkout upgTotal />
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

@endif
