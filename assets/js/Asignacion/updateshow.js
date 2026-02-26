document.addEventListener('DOMContentLoaded', function () {
    const compSelect = document.getElementById('COMPETENCIA_comp_id');
    const instSelect = document.getElementById('INSTRUCTOR_inst_id');

    if (compSelect && instSelect) {
        // Remove empty options if an instructor is selected on load
        const initialInstId = instSelect.value;

        compSelect.addEventListener('change', function () {
            const compId = this.value;

            instSelect.innerHTML = '<option value="">Cargando instructores...</option>';
            instSelect.disabled = true;

            if (compId) {
                fetch(`?controller=Asignacion&action=getInstructoresByCompetencia&comp_id=${compId}`)
                    .then(response => response.json())
                    .then(data => {
                        instSelect.innerHTML = '<option value="">Seleccione Instructor...</option>';
                        if (data.length > 0) {
                            data.forEach(inst => {
                                const option = document.createElement('option');
                                option.value = inst.id;
                                option.textContent = inst.nombre;
                                // Keep selection if it was the initial one (optional)
                                if (inst.id == initialInstId) {
                                    option.selected = true;
                                }
                                instSelect.appendChild(option);
                            });
                            instSelect.disabled = false;
                        } else {
                            instSelect.innerHTML = '<option value="">Aviso: Ningún instructor avalado vigente</option>';
                            if (window.calendar) {
                                window.calendar.removeAllEvents();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching instructors:', error);
                        instSelect.innerHTML = '<option value="">Error cargando instructores</option>';
                    });
            } else {
                instSelect.innerHTML = '<option value="">Primero seleccione una Competencia...</option>';
                if (window.calendar) {
                    window.calendar.removeAllEvents();
                }
            }
        });

        // Handle dynamically loading the calendar for the selected instructor
        instSelect.addEventListener('change', function () {
            const instructorId = this.value;
            if (instructorId && window.calendar) {
                fetch(`?controller=Asignacion&action=getEventosByInstructor&inst_id=${instructorId}`)
                    .then(response => response.json())
                    .then(events => {
                        window.calendar.removeAllEvents();
                        window.calendar.addEventSource(events);
                    })
                    .catch(err => console.error("Error fetching calendar", err));
            } else if (!instructorId && window.calendar) {
                window.calendar.removeAllEvents();
            }
        });
    }

    // Initialize the calendar
    var calendarEl = document.getElementById('calendar');
    if (calendarEl && typeof window.calendarEventsData !== 'undefined') {
        var defaultViewType = window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek';

        window.calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'es', // Español
            initialView: defaultViewType,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek'
            },
            slotMinTime: '06:00:00',
            slotMaxTime: '22:00:00',
            allDaySlot: false,
            events: window.calendarEventsData,
            eventClick: function (info) {
                alert('Detalles del evento en agenda:\n\n' + info.event.title + '\nInicio: ' + info.event.start.toLocaleString() + '\nFin: ' + info.event.end.toLocaleString());
            },
            eventDidMount: function (info) {
                if (info.event.id == window.editingAsigId) {
                    info.el.style.backgroundColor = '#fbbf24'; // Warning color to highlight the currently edited assignment
                    info.el.style.borderColor = '#d97706';
                    info.el.style.color = '#ffffff';
                }
            },
            height: 'auto'
        });

        window.calendar.render();
    }
});
