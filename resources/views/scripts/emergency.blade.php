
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
        // minDate: new Date().fp_incr(1)
        // maxDate: new Date().fp_incr(30) // 14 days from now
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


