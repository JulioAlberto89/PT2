// import { Calendar } from 'fullcalendar'

// document.addEventListener('DOMContentLoaded', function() {
//   const calendarEl = document.getElementById('calendar')
//   const calendar = new Calendar(calendarEl, {
//     locale: 'es',
//     height: 'auto',
//     headerToolbar: {
//       left: 'prev,next today',
//       center: 'title',
//       right: 'dayGridMonth,timeGridWeek,timeGridDay'
//     },
//     initialView: 'dayGridMonth',
//     dateClick: function(info) {
//       $('#createEventModal').modal('show');
//     }
//   });
//   calendar.render();
// });
import { Calendar } from 'fullcalendar'

document.addEventListener('DOMContentLoaded', function() {
  const calendarEl = document.getElementById('calendar')
  const calendar = new Calendar(calendarEl, {
    locale: 'es',
    height: 'auto',
    headerToolbar: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    initialView: 'dayGridMonth',
        dateClick: function(info) {
            $('#createEventModal').modal('show');
        },
        events: '/api/events',
        editable: true,
        eventDrop: function(info) {
            let eventData = {
                id: info.event.id,
                start: info.event.startStr,
                end: info.event.endStr
            };
            $.ajax({
                url: '/api/events/' + eventData.id,
                type: 'PUT',
                data: eventData,
                success: function(response) {
                    console.log('Evento actualizado correctamente.');
                },
                error: function(error) {
                    console.error('Error al actualizar el evento:', error);
                }
            });
        }
    });
  calendar.render();
});
