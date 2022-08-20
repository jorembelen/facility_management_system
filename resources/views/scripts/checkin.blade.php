
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>
<script>
    var f2 = flatpickr(document.getElementById('dateTimeFlatpickr'), {
        enableTime: false,
        dateFormat: "Y-m-d",
    });
    var today = new Date();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var f2 = flatpickr(document.getElementById('timeFlatpickr'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        defaultDate: time
    });
</script>


