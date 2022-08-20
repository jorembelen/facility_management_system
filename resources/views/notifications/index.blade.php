@extends('layouts.master')

@section('title', 'Read Notifications')

@section('content')

<div class="row">
    <div class="col-md-3"></div>
<div class="col-md-6">
    <div class="card flex-fill w-100">


            @livewire('notification-list')

    </div>
</div>
<div class="col-md-3"></div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.addEventListener('swal:modal', event => {
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
        });
    });
    window.addEventListener('swal:confirm', event => {
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if(willDelete) {
                    window.livewire.emit('clear');
            }
        });
    });
</script>

@endsection
