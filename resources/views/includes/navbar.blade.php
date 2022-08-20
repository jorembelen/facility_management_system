<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle">
        <i class="hamburger align-self-center"></i>
        <div id="MyClockDisplay" class="clock mt-2 deskContent" style="font-size: 17px;"  onload="showTime()"></div>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            {{-- <li class="nav-item dropdown show">
                <a class="nav-flag dropdown-toggle" href="#" id="languageDropdown" data-toggle="dropdown" aria-expanded="true">
                    <img src="/assets/img/flags/us.png" alt="English">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="#">
                        <img src="/assets/img/flags/us.png" alt="English" width="20" class="align-middle mr-1">
                        <span class="align-middle">English</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <img src="/assets/img/flags/sa.png" alt="Spanish" width="20" class="align-middle mr-1">
                        <span class="align-middle">Arabic</span>
                    </a>
                </div>
            </li> --}}
            @livewire('notification-component')
            @livewire('chat-notification-component')

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">

                    <img src="{{ auth()->user()->getAvatar() }}" class="avatar img-fluid rounded-circle mr-1" alt="{{ auth()->user()->name }}" >

                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Hello! {{ Auth::user()->name }}</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile', auth()->user()->id) }}"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}">Sign out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
