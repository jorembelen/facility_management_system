<div>

    <div class="card-header">
        <button class="badge badge-primary float-right" wire:click="deleteConfirm" {{ $totalNotifications > 0 ? '' : 'disabled' }}><i class="far fa-fw fa-trash-alt"></i> Clear Notifications</button>
        <h5 class="card-title mb-0">Notifications List</h5>
    </div>

    <div class="card-body">
        @forelse ($notifications as $notification)
        <div class="media">
            @php
            $user = \App\Models\User::find($notification->data['sender']);
            @endphp
            <img src="{{ $user->getAvatar() }}" class="avatar img-fluid rounded-circle mr-2" alt="{{ $notification->data['sender'] }}">
            <div class="media-body">
                <a href="{{ $notification->data['url'] }}"><strong>{{ $notification->data['data'] }}</strong></a>
                <small class="float-right text-navy">{{ $notification->created_at->diffForHumans() }}</small>
            </div><br>
        </div><br>
        @empty
        <p class="text-center">Your notification is empty.</p>
        @endforelse

        @if (auth()->user()->notifications())
        @if ($totalNotifications > 5 && $totalNotifications > $amount)
        <hr>
        <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-primary" wire:click="load">Load more</a>
        </div>
        @else
        @endif
        @endif
    </div>
</div>
