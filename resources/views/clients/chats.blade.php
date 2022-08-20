<div class="col-lg-5 col-xxl-5">
    <div class="card">
    <div class="card-header">
        <h3>Chat with us
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square align-middle mr-2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
        </h3>
    </div>
    <div class="card-body">
        <div class="row no-gutters">
            <div class="col-12 col-lg-12 col-xl-12">

                <div class="position-relative" >
                    <div class="chat-messages p-4">

                        @foreach ($chats as $chat)
                        @if (auth()->id() != $chat->user_id)
                        {{-- <div id="content"></div> --}}
                        <div class="chat-message-left pb-4">
                            <div>
                                @if ($chat->user->profile_photo_path == '')
                                    <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->getAvatar()) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                @else
                                    <img src="{{ asset('storage/uploads/avatar/' .$chat->user->profile_photo_path) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                @endif

                                <div class="text-muted small text-nowrap mt-2">{{ date('M-d-Y', strtotime($chat->created_at)) }}</div>
                                <div class="text-muted small text-nowrap">{{ $chat->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">
                                <div class="font-weight-bold mb-1">{{ $chat->user->name }}</div>
                                @if (auth()->id() != $chat->user_id)
                                <p class="text-primary"> {{$chat->message}}</p>
                                @else
                                {{$chat->message}}
                            @endif
                        </div>
                    </div>
                    @else
                    <div class="chat-message-right pb-4">
                            <div>
                                @if ($chat->user->profile_photo_path == '')
                                <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->getAvatar()) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                            @else
                                <img src="{{ asset('storage/uploads/avatar/' .$chat->user->profile_photo_path) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                            @endif
                                <div class="text-muted small text-nowrap mt-2">{{ date('M-d-Y', strtotime($chat->created_at)) }}</div>
                                <div class="text-muted small text-nowrap">{{ $chat->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                <div class="font-weight-bold mb-1">{{ $chat->user->name }}</div>
                                @if (auth()->id() != $chat->user_id)
                                <p class="text-primary"> {{$chat->message}}</p>
                                @else
                                {{$chat->message}}
                                @endif
                            </div>
                        </div>
                        @endif
                    @endforeach

                    </div>
                </div>

                @if ($appointment->status == 0)
                    <div class="flex-grow-0 py-3 px-4 border-top">
                        <form class="form-horizontal" method="POST" action="{{ route('chats.store') }}">
                            @csrf
                        <div class="input-group">
                                <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
                                <input type="hidden" name="client_appointment_id" value="{{ $appointment->id }}">
                            <input type="text" name="message" class="form-control" placeholder="Type your message" required>
                            <div class="input-group-append ml-1">
                                <button class="btn btn-primary">Send</button>
                            </div>
                            </form>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    </div>
</div>
