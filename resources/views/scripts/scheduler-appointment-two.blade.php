
<script src="/assets/plugins/flatpickr/flatpickr.js"></script>

<script>
    var f3 = flatpickr(document.getElementById('timeOne'), {
        mode: 'multiple',
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
    var f4 = flatpickr(document.getElementById('timeTwo'), {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
    });
</script>



