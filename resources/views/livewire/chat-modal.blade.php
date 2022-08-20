
<!-- create modal content -->
<div id="chat" class="modal fade" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel">Chat with us</h3>
                <button type="button" class="close" wire:click.prevent="close">×</button>
                {{-- <button onClick="scrollToBottom('chat-content')">Scroll to Bottom</button> --}}
            </div>
            <div class="modal-body">


                <div wire:poll.visible.5s>
                    <form wire:submit.prevent="sendMessage('{{ $appointment->id }}')" >
                        <div class="chatScroll" id="chatScroll" >

                            @foreach ($chats as $chat)

                            @if (auth()->id() != $chat->user_id)
                            <div class="media media-chat">
                                <img class="avatar" src="{{ $chat->user->getAvatar() }}" class="rounded-circle" alt="...">
                                <div class="media-body">
                                    <h6>{{ $chat->user->name }}</h6>
                                    <h5 class="text-time">{{ $chat->created_at->diffForHumans() }}</h5>
                                    <p class="text-dark">{{$chat->message}}</p>
                                </div>
                            </div>
                            @else
                            <div class="media media-chat media-chat-reverse">
                                <img class="avatar" src="{{ $chat->user->getAvatar() }}" class="rounded-circle" alt="...">
                                <div class="media-body">
                                    <h6 class="text-right">You</h6>
                                    <h5 class="text-time">{{ $chat->created_at->diffForHumans() }}</h5>
                                    <p class="text-primary" style="background-color: #DAEAF1;">{{$chat->message}}</p> <br>
                                </div>
                            </div>
                            @endif

                            @endforeach

                            <div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 0px;"><div class="ps-scrollbar-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; height: 0px; right: 2px;"><div class="ps-scrollbar-y" tabindex="0" style="top: 0px; height: 2px;"></div></div></div>

                            @if ($appointment->status == 0)
                            <div class="publisher bt-1 border-light">
                                <img class="avatar avatar-xs" src="{{ auth()->user()->getAvatar() }}" class="rounded-circle" alt="...">
                                {{-- <input type="text" class="publisher-input" wire:model.lazy="message" placeholder="Type message" id="chatArea"> --}}
                                <textarea wire:model.lazy="message" placeholder="Type message" id="chatArea" class="form-control"></textarea>
                                <a class="publisher-btn text-info" href="#" wire:click.prevent="sendMessage('{{ $appointment->id }}')"><i class="fa fa-paper-plane"></i></a>
                            </div>
                            @endif
                            @error('message') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

  <!-- Cancel Appointment -->
  <div class="modal fade" id="cancelApp" wire:ignore.self>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleStandardModalLabel"><i class="align-middle mr-2 far fa-fw fa-frown" style="color:red"></i> Cancel Appointment?</h3>
                <button type="button" class="close" wire:click.prevent="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body m-3">
                <h4 class="mb-0 text-center">If you are sure, please select reason & click Yes to proceed.</h4>
                <div class="form-group mt-2">
                    <select wire:model="cancellation_reason" class="form-control" id="reason_frm" >
                        <option value="">Select Reason</option>
                        <option value="Problem Solved">Problem Solved</option>
                        <option value="Busy, cannot attend appointment">Busy, cannot attend appointment</option>
                        <option value="Others">Others</option>
                    </select>
                    @error('cancellation_reason')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group" style="display:{{ $cancellation_reason == 'Others' ? null : 'none' }}">
                    <textarea wire:model.defer="cancellation_comments" class="form-control" cols="30" rows="3" placeholder="Comments"></textarea>
                    @error('cancellation_comments')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <div wire:loading wire:target="cancelAppointment" class="progress-bar progress-bar-striped progress-bar-animated" role="status" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Cancelling . . .</div>

                <div wire:loading.remove wire:target="cancelAppointment">
                    <button  class="btn btn-dark waves-effect waves-light" wire:click.prevent="cancelAppointment('{{ $appId }}')">Submit</button>
                    <button class="btn btn-danger waves-effect" wire:click.prevent="close">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
