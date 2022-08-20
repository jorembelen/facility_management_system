
<div>

    <main class="content">
        <div class="container-fluid p-0">

            <h1 class="h3 mb-3">Messages</h1>

            <div class="card">
                <div class="row no-gutters">
                    {{-- <div class="col-12 col-lg-5 col-xl-3 border-right">

                        <div class="px-4 d-none d-md-block">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <input type="text" class="form-control my-3" placeholder="Search...">
                                </div>
                            </div>
                        </div>

                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="badge badge-success float-right">5</div>
                            <div class="media">
                                <img src="img/avatars/avatar-5.jpg" class="rounded-circle mr-1" alt="Ashley Briggs" width="40" height="40">
                                <div class="media-body ml-3">
                                    Ashley Briggs
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="badge badge-success float-right">2</div>
                            <div class="media">
                                <img src="img/avatars/avatar-2.jpg" class="rounded-circle mr-1" alt="Carl Jenkins" width="40" height="40">
                                <div class="media-body ml-3">
                                    Carl Jenkins
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-3.jpg" class="rounded-circle mr-1" alt="Bertha Martin" width="40" height="40">
                                <div class="media-body ml-3">
                                    Bertha Martin
                                    <div class="small"><span class="fas fa-circle chat-online"></span> Online</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-4.jpg" class="rounded-circle mr-1" alt="Stacie Hall" width="40" height="40">
                                <div class="media-body ml-3">
                                    Stacie Hall
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-5.jpg" class="rounded-circle mr-1" alt="Fiona Green" width="40" height="40">
                                <div class="media-body ml-3">
                                    Fiona Green
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-2.jpg" class="rounded-circle mr-1" alt="Doris Wilder" width="40" height="40">
                                <div class="media-body ml-3">
                                    Doris Wilder
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-4.jpg" class="rounded-circle mr-1" alt="Haley Kennedy" width="40" height="40">
                                <div class="media-body ml-3">
                                    Haley Kennedy
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="media">
                                <img src="img/avatars/avatar-3.jpg" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">
                                <div class="media-body ml-3">
                                    Jennifer Chang
                                    <div class="small"><span class="fas fa-circle chat-offline"></span> Offline</div>
                                </div>
                            </div>
                        </a>

                        <hr class="d-block d-lg-none mt-1 mb-0" />
                    </div> --}}
                    <div class="col-9 col-lg-9 col-xl-9">
                        <div class="py-2 px-4 border-bottom d-none d-lg-block">
                            <div class="media align-items-center py-1">
                                <div class="position-relative">
                                    @if (auth()->user()->profile_photo_path == '')
                                    <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->getAvatar()) }}" class="rounded-circle mr-1" alt="{{ auth()->user()->name }}" width="40" height="40">
                                    @else
                                    <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->profile_photo_path) }}" class="rounded-circle mr-1" alt="{{ auth()->user()->name }}" width="40" height="40">
                                    @endif
                                </div>
                                <div class="media-body pl-3">
                                    <strong>Bertha Martin</strong>
                                    <div class="text-muted small"><em>Typing...</em></div>
                                </div>

                            </div>
                        </div>

                        <div class="position-relative">
                            <div class="chat-messages p-4">

                            @foreach ($chats as $chat)

                            @if (auth()->id() != $chat->user_id)
                                <div class="chat-message-right pb-4">
                                    <div>
                                        @if ($chat->user->profile_photo_path == '')
                                        <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->getAvatar()) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                        @else
                                        <img src="{{ asset('storage/uploads/avatar/' .$chat->user->profile_photo_path) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                        @endif
                                        <div class="text-muted small text-nowrap">{{ $chat->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <div class="font-weight-bold mb-1">You</div>
                                        {{$chat->message}}
                                    </div>
                                </div>
                            @else
                                <div class="chat-message-left pb-4">
                                    <div>
                                        @if ($chat->user->profile_photo_path == '')
                                        <img src="{{ asset('storage/uploads/avatar/' .auth()->user()->getAvatar()) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                        @else
                                        <img src="{{ asset('storage/uploads/avatar/' .$chat->user->profile_photo_path) }}" class="rounded-circle mr-1" alt="{{ $chat->user->name }}" width="40" height="40">
                                        @endif
                                        <div class="text-muted small text-nowrap">{{ $chat->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-primary-light text-light rounded py-2 px-3 ml-3">
                                        <div class="font-weight-bold mb-1">Bertha Martin</div>
                                        {{$chat->message}}
                                    </div>
                                </div>
                            @endif
                            @endforeach

                            </div>
                        </div>


                        @if ($appointment->status == 0)
                        <div class="flex-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type your message" required wire:model.lazy="message">
                                <div class="input-group-append ml-1">
                                    <button class="btn btn-primary" wire:click.prevent="chat('{{ $appointment->id }}')">Send</button>
                                </div>
                            </div>
                            @error('message') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </main>

</div>
