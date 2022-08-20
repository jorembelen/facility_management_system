<div wire:poll.10s>

    <li class="nav-item dropdown">
        <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-toggle="dropdown" aria-expanded="false">
            <div class="position-relative">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-circle align-middle"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>

                @if ($chatNotifications->count() > 0)
                <span class="indicator">{{ $totalNotifications }}</span>
                @endif
            </div>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0" aria-labelledby="messagesDropdown" >
            <div class="dropdown-menu-header">
                <div class="position-relative">
                    You have {{ $chatNotifications->count() }} unread Message(s)
                </div>
            </div>
            <div class="list-group">
                @foreach ($chatNotifications  as $notification)
                <a href="{{ $notification->data['url'] }}" class="list-group-item" wire:click="read('{{ $notification->id }}')">
                    <div class="row no-gutters align-items-center">
                        <div class="col-2">
                            @php
                            $user = \App\Models\User::find($notification->data['sender']);
                            @endphp
                            <img src="{{ $user->getAvatar() }}" class="avatar img-fluid rounded-circle" alt="{{ $notification->data['sender'] }}">
                        </div>
                        <div class="col-10 pl-2">
                            <div class="text-dark">{{ $notification->data['data'] }}</div>
                            <div class="text-muted small mt-1">{{ $notification->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </a>
                @endforeach
                @if (auth()->user()->unreadNotifications->count() > 0)
                <div class="dropdown-menu-footer">
                    <a href="#" class="text-muted" role="button" wire:click="clear">Mark all as Read</a>
                </div>
                @endif

            </div>
        </div>
    </li>
</div>

