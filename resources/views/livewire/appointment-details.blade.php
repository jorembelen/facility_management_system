@section('title')
Appointment Information
@endsection

<div>
    <div class="row">
        <div class="col-lg-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-action float-right">
                        <div class="dropdown show">
                            @if (auth()->user()->role == 'tenant')
                            <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route( 'appointment.index') }}" class="btn btn-secondary float-right d-print-none "><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            @else
                            <a href="{{ session()->has('previousRoute') ? url(session()->get('previousRoute')) : route('appointments.open') }}" class="btn btn-secondary float-right d-print-none "><i class="fas fa-arrow-alt-circle-left"></i> Back</a>
                            @endif
                        </div>
                    </div>
                    <h5 class="mb-0 mt-4">Status:  </h5>
                    @if ($appointment->status == 0)
                    <span class="badge badge-primary ml-2">Open</span>
                    @elseif ($appointment->status == 1)
                    <span class="badge badge-success ml-2">Closed</span>
                    @else
                    <span class="badge badge-danger ml-2">Cancelled</span>
                    <h5 class="ml-2 mt-4">Cancellation Reason: {{ $appointment->cancellation_reason == 'Others' ? $appointment->cancellation_comments : $appointment->cancellation_reason }}</h5>
                    @endif

                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Work Category:</dt>
                        <h5>{{ $appointment->category->name }}</h5>
                    </dl>
                    @if ($appointment->emergency_type)
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Emergency Type:</dt>
                        <h5>{{ $appointment->emergency_type }}</h5>
                    </dl>
                    @endif
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Date:</dt>
                        <h5>{{ $appointment->date->format('M-d-Y') }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">Scheduled Time:</dt>
                        <h5>{{ $appointment->schedule_time }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3">location:</dt>
                        <h5>{{ $appointment->job_location }}</h5>
                    </dl>
                    <dl class="row">
                        <dt class="col-4 col-xxl-3"><i class="align-middle mr-2 fas fa-fw fa-arrow-down"></i> Complain:</dt>
                    </dl>
                    <dl class="row">
                        <h5 class="text-justify ml-3 mr-3 mt-2">{{ $appointment->job_description }}</h5>
                    </dl>
                    <dl class="row">
                    </dl>

                    <hr>

                    <h5>Attached Document </h5>
                    @if ($appointment->status == 0)
                        @if($appointment->documents)
                        <a href="{{ Storage::disk('s3')->url('uploads/documents/'.$appointment->documents) }}" target="_blank" rel="noopener noreferrer">
                            <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3 text-center">
                                <img src="{{ asset('assets/img/pdf.png') }}"  alt="attach image" height="150">
                                <p>Click to view file</p>
                            </div>
                        </a>
                        @else
                        <h5 class="text-center">No Document Attached!</h5>
                        @endif
                    @endif
                    <hr>

                    <div class="widget-content widget-content-area" wire:ignore>
                        <h5>Picture(s)</h5>
                        <div id="demo-test-gallery" class="demo-gallery" data-pswp-uid="1" wire:ignore>
                            @if(!empty($appointment->images))
                            @php
                            $photos = explode('|', $appointment->images);
                            @endphp
                            @foreach ($photos as $image)

                            <a class="img-1" href="{{ Storage::disk('s3')->url('uploads/images/'.$image ) }}" data-size="1600x1068" data-med="{{ $image ? Storage::disk('s3')->url('uploads/thumbnails/' .$image) : 'no_image.jpg' }}" data-med-size="1024x683" data-author="{{ $image }}">
                                <img src="{{ Storage::disk('s3')->url('uploads/thumbnails/'.$image) }}" alt="image-gallery">

                            </a>
                            @endforeach
                            @else
                            <h5 class="text-center">No Picture(s) Attached</h5>
                            @endif
                        </div>
                        <!-- Root element of PhotoSwipe. Must have class pswp. -->
                        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

                            <!-- Background of PhotoSwipe. It's a separate element, as animating opacity is faster than rgba(). -->
                            <div class="pswp__bg"></div>

                            <!-- Slides wrapper with overflow:hidden. -->
                            <div class="pswp__scroll-wrap">
                                <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
                                <!-- don't modify these 3 pswp__item elements, data is added later on. -->
                                <div class="pswp__container">
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                    <div class="pswp__item"></div>
                                </div>

                                <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
                                <div class="pswp__ui pswp__ui--hidden">

                                    <div class="pswp__top-bar">

                                        <!--  Controls are self-explanatory. Order can be changed. -->
                                        <div class="pswp__counter"></div>
                                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                                        <button class="pswp__button pswp__button--share" title="Share"></button>
                                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                                        <!-- element will get class pswp__preloader--active when preloader is running -->
                                        <div class="pswp__preloader">
                                            <div class="pswp__preloader__icn">
                                                <div class="pswp__preloader__cut">
                                                    <div class="pswp__preloader__donut"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                                        <div class="pswp__share-tooltip"></div>
                                    </div>
                                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
                                    </button>
                                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
                                    </button>
                                    <div class="pswp__caption">
                                        <div class="pswp__caption__center"></div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                @if ($appointment->status == 1)
                @if (in_array(auth()->user()->role, ['supervisor', 'scheduler', 'admin', 'super_admin']))
                @if(!empty($appointment->closing_attachment))
                <a class="bs-tooltip" title="Click to download this attachment!" href="{{ Storage::disk('s3')->url('uploads/documents/'.$appointment->closing_attachment) }}" target="_blank" rel="noopener noreferrer">
                    <div class="col-6 col-md-4 col-sm-6 col-lg-4 col-xl-3">
                        <img src="{{ asset('assets/img/pdf.png') }}"  alt="attach image" height="150">
                        <p>Click to view file</p>
                    </div>
                </a>
                @endif
                <hr>
                <h3>Job Orders Appointments</h3>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Technicians</th>
                            <th>Appointment Date</th>
                            <th>Appointment Time</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($jobOrders as $jobOrder)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jobOrder->technicians }}</td>
                            <td>{{ $jobOrder->date->format('M-d-Y') }}</td>
                            <td>{{ $jobOrder->time }}</td>
                            <td>{{ $jobOrder->notes }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                @endif
            </div>

        </div>
        @if (in_array(auth()->user()->role, ['supervisor', 'scheduler', 'tenant']))
        @if ($appointment->status == 0)
        @if (count($appointment->jobOrder) == 0)

        <a class="btn btn-primary" href="#" wire:click.prevent="cancel('{{$appointment->id}}')">Cancel Appointment </a>

        @endif
        <a class="btn btn-warning" href="{{ route('edit.appointment', $appointment->id) }}">Update</a>
        @endif
        @endif
    </div>


    @include('livewire.chat-modal')
    <a href="#" class="float" wire:click.prevent="chatMe('{{ $appointment->id }}')">
        <i class="fa fa-comments my-float"></i>
        <span class="m-count" wire:poll.10s>{{ $appointment->getUnreadChat() }}</span>
    </a>
    <div class="label-container">
        <div class="label-text">Chat with Us</div>
        <i class="fa fa-play label-arrow"></i>
    </div>
</div>


</div>
</div>


@push('appointment-js')

<script>
    let container = document.querySelector('#chatScroll');
    window.addEventListener('DOMContentLoaded', () => {
        scrollDown();
    });
    window.addEventListener('scrollDown', () => {
        let container = document.querySelector('#chatScroll');
        Livewire.hook('message.processed', () => {
            if(container.scrollTop + container.scrollHeight + 100 < container.scrollHeight) {
                return;
            }
            container.scrollTop = container.scrollHeight;
        });
        container.scrollTop = container.scrollHeight;
    });
    function scrollDown() {
        container.scrollTop = container.scrollHeight;
    }
    $('#chat').on('shown.bs.modal', function () {
        $('#chatArea').focus();
    })
</script>
@endpush



