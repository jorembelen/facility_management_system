
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>

<script>
    var f3 = flatpickr(document.getElementById('flatpickrOne'), {
        mode: 'multiple',
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    var f4 = flatpickr(document.getElementById('flatpickrTwo'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    $(document).ready(function() {
        $('.workLocation').select2();
    });
</script>
