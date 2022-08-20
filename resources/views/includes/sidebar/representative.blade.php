
 @if(auth()->user()->role == 'representative')
 <li class="sidebar-item {{ (request()->segment(1) == 'occupied-facilities') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('facilities.occupied') }}">
        <i class="fa fa-user-plus"></i><span class="align-middle">
           Occupied Facilities</span>
    </a>
</li>
 <li class="sidebar-item {{ (request()->segment(1) == 'vacant-facilities') ? 'active' : '' }}">
     <a class="sidebar-link" href="{{ route('facilities.vacant') }}">
         <i class="fa fa-user-minus"></i><span class="align-middle">
             Vacant Facilities</span>
     </a>
 </li>
 <li class="sidebar-item {{ (request()->segment(1) == 'assigned-facilities') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('facilities.assigned') }}">
        <i class="fa fa-user-tag"></i><span class="align-middle">
            Assigned Facilities</span>
    </a>
</li>
 <li class="sidebar-item {{ (request()->segment(1) == 'facilities-restoration') ? 'active' : '' }}">
    <a class="sidebar-link" href="{{ route('restoration') }}">
        <i class="fa fa-user-tag"></i><span class="align-middle">
            Under Restoration</span>
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
