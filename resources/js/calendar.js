import { Calendar } from 'fullcalendar';

document.addEventListener('DOMContentLoaded', function() {
    const calendarEl = document.getElementById('calendar');
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
            let dateWithTime = info.dateStr + ' ' + new Date().toTimeString().slice(0,8);
            $('#eventStart').val(dateWithTime);
            $('#eventEnd').val(dateWithTime);
        },        
        events: '/api/events',
        editable: true,
        eventDrop: function(info) {
            let eventData = {
                id: info.event.id,
                start_date: info.event.startStr,
                end_date: info.event.endStr
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
        },
        eventClick: function(info) {
            const event = info.event;
            $("#eventModal").modal("show");
            $("#editEventTitle").val(event.title);

            let startDate = new Date(event.start);
            let endDate = new Date(event.end);

            $("#editEventStart").val(startDate.toISOString().slice(0, 16));
            $("#editEventEnd").val(endDate.toISOString().slice(0, 16));
            $("#editEventTypeId").val(event.extendedProps.event_type_id);
            $("#editEventId").val(event.id);
        }
    });
    calendar.render();

    function validateDates(startDate, endDate) {
        if (new Date(startDate) > new Date(endDate)) {
            alert('La fecha de inicio no puede ser posterior a la fecha de fin.');
            return false;
        }
        return true;
    }

    $('#createEventForm').on('submit', function(e) {
        e.preventDefault();
        const startDate = $('#eventStart').val();
        const endDate = $('#eventEnd').val();
        if (!validateDates(startDate, endDate)) {
            return;
        }
        const data = $(this).serialize();
        $.ajax({
            url: '/api/events',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#createEventModal').modal('hide');
                calendar.refetchEvents();
                alert('Evento creado correctamente.');
            },
            error: function(error) {
                alert('Error al crear el evento.');
            }
        });
    });

    $('#editEventForm').on('submit', function(e) {
        e.preventDefault();
        const startDate = $('#editEventStart').val();
        const endDate = $('#editEventEnd').val();
        if (!validateDates(startDate, endDate)) {
            return;
        }
        const eventId = $('#editEventId').val();
        const url = `/api/events/${eventId}`;
        const data = $(this).serialize();
        $.ajax({
            url: url,
            type: 'PUT',
            data: data,
            success: function(response) {
                $('#eventModal').modal('hide');
                calendar.refetchEvents();
            },
            error: function(error) {
                alert('Error al actualizar el evento.');
            }
        });
    });

    $("#deleteEvent").on("click", function (e) {
        e.preventDefault();
        const eventId = $("#editEventId").val();
        const url = `/api/events/${eventId}`;
        const data = $("#editEventForm").serialize();
        $.ajax({
            url: url,
            type: "DELETE",
            data: data,
            success: function (response) {
                if (response.success) {
                    $("#eventModal").modal("hide");
                    calendar.refetchEvents();
                } else {
                    alert("Error al eliminar el evento.");
                }
            },
            error: function (error) {
                console.error("Error al eliminar el evento:", error);
                alert("Error al encontrar el evento.");
            },
        });
    });
});
