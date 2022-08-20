
<div wire:poll.10s>
    <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-toggle="dropdown" aria-expanded="false">
            <div class="position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell align-middle mr-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>
                @if ($allNotifications > 0)
                <span class="indicator">{{ $allNotifications }}</span>
                @endif
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="alertsDropdown" >

            <div class="dropdown-menu-header">
                You have {{ $allNotifications }} unread notification(s)
            </div>
            <div class="list-group">
                @foreach ($notifications  as $notification)
                <a href="{{ $notification->data['url'] }}" class="list-group-item" wire:click="read('{{ $notification->id }}')">
                    <div class="row no-gutters align-items-center">

                        <div class="col-2">
                            @php
                            $user = \App\Models\User::find($notification->data['sender']);
                            @endphp
                            <img src="{{ $user->getAvatar() }}" class="avatar img-fluid rounded-circle" alt="{{ $notification->data['sender'] }}">
                        </div>

                        <div class="col-10">
                            <div class="text-dark">{{ $notification->data['data'] }}</div>
                            <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>

                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="dropdown-menu-footer">
                @if ($allNotifications > 0)
                <a href="#" class="text-muted" role="button" wire:click="readAllNotification">Mark all as Read</a>
                <br>
                @endif
                <a href="{{ route('notification.index') }}" class="text-muted">Show all notifications</a>
            </div>
        </div>
    </li>
</div>
