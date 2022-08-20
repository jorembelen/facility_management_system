
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
    window.addEventListener('swal:confirmCancel', event => {
        swal({
            title: event.detail.title,
            text: event.detail.text,
            icon: event.detail.type,
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
                if(willDelete) {
                    window.livewire.emit('cancel', event.detail.id);
            }
        });
    });
</script>
