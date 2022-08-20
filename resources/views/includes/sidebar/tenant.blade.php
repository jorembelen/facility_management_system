
      @if(auth()->user()->role == 'tenant')
      {{-- <li class="sidebar-item {{ (request()->segment(1) == 'client-appointments') ? 'active' : '' }}">
          <a class="sidebar-link" href="{{ route('client-appointments.index') }}">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar align-middle mr-2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
              Appointments تعيينات</span>
          </a>
      </li> --}}
      <li class="sidebar-item {{ (request()->is('tenant/appointments*')) ? 'active' : '' }}">
        <a href="#appointments" data-toggle="collapse" class="sidebar-link">
            <i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Appointments</span>
        </a>
        <ul id="appointments" class="sidebar-dropdown list-unstyled collapse {{ (request()->is('tenant/appointments*')) ? 'show' : '' }}" data-parent="#sidebar">
            <li class="sidebar-item {{ (request()->is('tenant/appointments/0')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenant.appointments', 0) }}">Open</a></li>
            <li class="sidebar-item {{ (request()->is('tenant/appointments/1')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenant.appointments', 1) }}">Closed</a></li>
            <li class="sidebar-item {{ (request()->is('tenant/appointments/2')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenant.appointments', 2) }}">Cancelled</a></li>
            <li class="sidebar-item {{ (request()->is('tenant/appointments/3')) ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('tenant.appointments', 3) }}">All</a></li>
            {{-- <li class="sidebar-item {{ (request()->segment(1) == 'closed-appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.closed') }}">Closed</a></li>
            <li class="sidebar-item {{ (request()->segment(1) == 'cancelled-appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.cancelled') }}">Cancelled</a></li>
            <li class="sidebar-item {{ (request()->segment(1) == 'appointments') ? 'active' : '' }}"><a class="sidebar-link" href="{{ route('appointments.index') }}">All</a></li> --}}
        </ul>
    </li>
      <li class="sidebar-item {{ (request()->segment(1) == 'tenants-create-appointment') ? 'active' : '' }}">
        <a class="sidebar-link" href="{{ route('create.appointments') }}">
            <i class="align-middle" data-feather="plus-circle"></i> <span class="align-middle">Create Appointment إنشاء موعد</span>
        </a>
    </li>
      @endif
