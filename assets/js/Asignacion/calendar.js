document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');

    // Check if the calendar element and events data exists before initializing
    if (calendarEl && typeof window.calendarEventsData !== 'undefined') {
        var defaultViewType = window.innerWidth < 768 ? 'timeGridDay' : 'dayGridMonth';

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es', // Español
            initialView: defaultViewType,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            slotMinTime: '06:00:00', // Horario de mañana Sena
            slotMaxTime: '22:00:00', // Horario de noche Sena
            allDaySlot: false,
            events: window.calendarEventsData,
            dateClick: function (info) {
                // Change the view to day grid and go to the clicked date
                calendar.changeView('timeGridDay', info.dateStr);
            },
            eventClick: function (info) {
                // Prevenir el comportamiento por defecto si acaso
                info.jsEvent.preventDefault();
                
                // Extraer los datos del título (que tiene formato: Ficha: X \n Amb: Y \n Comp: Z)
                var titleLines = info.event.title.split('\n');
                var ficha = titleLines.length > 0 ? titleLines[0].replace('Ficha: ', '') : 'Desconocida';
                var ambiente = titleLines.length > 1 ? titleLines[1].replace('Amb: ', '') : 'Desconocido';
                var competencia = titleLines.length > 2 ? titleLines[2].replace('Comp: ', '') : 'Desconocida';
                
                // Formatear el horario
                var startTime = info.event.start ? info.event.start.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : '';
                var endTime = info.event.end ? info.event.end.toLocaleTimeString([], {hour: '2-digit', minute:'2-digit'}) : '';
                var timeString = startTime + ' - ' + endTime;
                
                // Llenar datos en el HTML del Modal
                document.getElementById('modalEventTitle').textContent = '#' + ficha;
                document.getElementById('modalEventTime').textContent = timeString;
                document.getElementById('modalEventAmbiente').textContent = ambiente;
                document.getElementById('modalEventCompetencia').textContent = competencia;
                
                // Si es coordinador, configurar los enlaces
                if (window.isCoordinador && info.event.id) {
                    var btnEditDay = document.getElementById('btnEditDay');
                    var btnEditAll = document.getElementById('btnEditAll');
                    
                    if (btnEditAll) {
                        btnEditAll.href = '?controller=Asignacion&action=updateshow&id=' + info.event.id;
                    }
                    if (btnEditDay && info.event.extendedProps && info.event.extendedProps.detasig_id) {
                        btnEditDay.href = '?controller=DetalleAsignacion&action=updateshow&id=' + info.event.extendedProps.detasig_id;
                    }
                }
                
                // Mostrar el Modal con un ligero efecto popup
                var modal = document.getElementById('eventModal');
                var modalContent = modal.querySelector('.event-modal-content');
                modal.style.display = 'flex';
                
                // Pequeño delay para que aplique la transición CSS
                setTimeout(function() {
                    modalContent.style.transform = 'scale(1)';
                }, 10);
            },
            height: 'auto'
        });

        calendar.render();
    }
});
