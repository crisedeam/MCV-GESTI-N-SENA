<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Mi Horario</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Mi Horario</h1>
            <p>Visualiza tus programaciones asignadas.</p>
        </div>
        <div class="header-actions">
            <!-- Acciones como botón imprimir PDF o exportar -->
            <button class="btn-primary" onclick="window.print()">
                <i class="fa-solid fa-print"></i> Imprimir Horario
            </button>
        </div>
    </div>

    <!-- Contenedor del Calendario -->
    <div class="table-card" style="padding: 20px;">
        <div id="calendar"></div>
    </div>
</div>

<!-- FullCalendar CSS y JS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

<link rel="stylesheet" href="assets/css/calendar.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var defaultViewType = window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek';

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
            events: <?php echo $eventosJson; ?>,
            dateClick: function(info) {
                // Redirigir a la vista de registrar asignación con la fecha (y hora)
                window.location.href = '?controller=Asignacion&action=register&date=' + encodeURIComponent(info.dateStr);
            },
            eventClick: function(info) {
                alert('Detalles del evento:\n\n' + info.event.title);
            },
            height: 'auto'
        });

        calendar.render();
    });
</script>
