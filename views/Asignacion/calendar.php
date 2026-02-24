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

<style>
    #calendar {
        max-width: 100%;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }
    .fc-event {
        cursor: pointer;
        padding: 4px;
        white-space: pre-wrap; /* Permite saltos de linea en el titulo (\n) */
        font-size: 0.85em;
        line-height: 1.3;
    }
    .fc-header-toolbar {
        margin-bottom: 20px !important;
    }
    .fc-toolbar-title {
        font-family: 'Outfit', sans-serif;
        color: #39A900;
        font-weight: 600;
    }
    .fc-button-primary {
        background-color: #39A900 !important;
        border-color: #39A900 !important;
    }
    .fc-button-primary:not(:disabled):active, 
    .fc-button-primary:not(:disabled).fc-button-active {
        background-color: #2e8b00 !important;
        border-color: #2e8b00 !important;
    }
    /* Estilos de impresion */
    @media print {
        .sidebar, .top-header, .breadcrumb, .view-header, .btn-primary {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }
        #calendar {
            width: 100%;
        }
    }
</style>

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
            eventClick: function(info) {
                alert('Detalles del evento:\n\n' + info.event.title);
            },
            height: 'auto'
        });

        calendar.render();
    });
</script>
