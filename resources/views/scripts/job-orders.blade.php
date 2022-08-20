
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1)
    });
    var f5 = flatpickr(document.getElementById('dateTimeFlatpickrTwo'), {
        enableTime: false,
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1)
    });
</script>

<script>
    var f3 = flatpickr(document.getElementById('timeFlatpickr'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    var f4 = flatpickr(document.getElementById('timeTwoFlatpickr'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>


