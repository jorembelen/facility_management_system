
 @if(auth()->user()->role == 'assigner')

 <li class="sidebar-item {{ (in_array(request()->segment(1), ['facilities', 'occupied-facilities', 'vacant-facilities', 'facilities-restoration' ])) ? 'active' : '' }}">
    <a href="#facilities" data-toggle="collapse" class="sidebar-link">
        <i class="align-middle" data-feather="home"></i> <span class="align-middle">Facilities</span>
    </a>
    <ul id="facilities" class="sidebar-dropdown list-unstyled collapse {{ (in_array(request()->segment(1), ['facilities', 'occupied-facilities', 'vacant-facilities', 'facilities-restoration' ])) ? 'show' : '' }}" data-parent="#sidebar">
        <li class="sidebar-item {{ (request()->segment(1) == 'occupied-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.occupied') }}">Occupied</a></li>
        <li class="sidebar-item {{ (request()->segment(1) == 'vacant-facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.vacant') }}">Vacant</a></li>
        <li class="sidebar-item {{ (request()->segment(1) == 'facilities-restoration') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('restoration') }}">Under Restoration</a></li>
        <li class="sidebar-item {{ (request()->segment(1) == 'facilities') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('facilities.index') }}">All Facilities</a></li>
    </ul>
</li>

 <li class="sidebar-item {{ (request()->segment(1) == 'staff-list') ? 'active' : '' }}">
     <a class="sidebar-link" href="{{ route('staff.list') }}">
         <i class="fa fa-users"></i><span class="align-middle">
             Staff List</span>
     </a>
 </li>
 <li class="sidebar-item {{ (request()->segment(1) == 'assign-facility') ? 'active' : '' }}">
     <a class="sidebar-link" href="{{ route('assign-facilty.tenant') }}">
         <i class="fa fa-user-plus"></i><span class="align-middle">
             Assign Tenant</span>
     </a>
 </li>
 <li class="sidebar-item {{ (request()->segment(1) == 'assigned-facilities') ? 'active' : '' }}">
     <a class="sidebar-link" href="{{ route('facilities.assigned') }}">
         <i class="fa fa-user-tag"></i><span class="align-middle">
             Assigned Facilities</span>
     </a>
 </li>


 @endif
