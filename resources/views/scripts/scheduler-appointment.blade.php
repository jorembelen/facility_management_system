
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>

<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: "today" // 14 days from now
    });
</script>

<script>
    $(document).ready(function() {
        $('.workLocation').select2();
    });
</script>
