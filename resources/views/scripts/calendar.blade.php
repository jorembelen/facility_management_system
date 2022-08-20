

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var calendarEl = document.getElementById('fullcalendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            displayEventTime : false,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },

            events: [
            @foreach($appointments as $appointment)
            {
                title: '{{ $appointment->schedule_time }} - {{ $appointment->category->name }}',
                start: '{{ $appointment->date }}',
                url: '{{ route('appointment.info',$appointment->id) }}',
            },
            @endforeach
            ],
            eventColor: '#378006'

        });
        setTimeout(function() {
            calendar.render();
        }, 250)
    });
</script>


