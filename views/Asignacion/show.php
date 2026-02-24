<div class="view-container">
    <div class="breadcrumb">
        <span>Ejecución</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Asignaciones</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Asignaciones</h1>
            <p>Control de horarios y programación de instructores.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar asignación..." onkeyup="filterTable()">
            </div>
            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
            <a href="?controller=Asignacion&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Asignación
            </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> La Asignación no puede ser eliminada porque tiene otros registros (como detalles de horario) dependiendo de ella.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error al intentar eliminar el registro.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <!-- Dashboard Mini -->
    <div class="dashboard-grid">
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e6fced; color: #39A900;">
                <i class="fa-solid fa-calendar-check"></i>
            </div>
            <div class="stat-details">
                <h3>Total Asignaciones</h3>
                <p class="stat-number"><?php echo $totalAsignaciones ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                <i class="fa-regular fa-clock"></i>
            </div>
            <div class="stat-details">
                <h3>Programación</h3>
                <p class="stat-number">Activa</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID ASIGNACIÓN</th>
                    <th>INSTRUCTOR</th>
                    <th>FICHA</th>
                    <th>AMBIENTE</th>
                    <th>COMPETENCIA</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaAsignaciones)): ?>
                <tr>
                    <td colspan="8" class="empty-table-message">
                        No hay asignaciones registradas todavía. <br>
                        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                        Utilice el botón "Nueva Asignación" para agregar una.
                        <?php endif; ?>
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaAsignaciones as $asignacion): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($asignacion->getASIG_ID()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($asignacion->getINSTRUCTOR_inst_id()) ?></td>
                        <td><?= htmlspecialchars($asignacion->getFICHA_fich_id()) ?></td>
                        <td><?= htmlspecialchars($asignacion->getAMBIENTE_amb_id()) ?></td>
                        <td><?= htmlspecialchars($asignacion->getCOMPETENCIA_comp_id()) ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($asignacion->getAsig_fecha_ini()))) ?></td>
                        <td><?= htmlspecialchars(date('d/m/Y H:i', strtotime($asignacion->getAsig_fecha_fin()))) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=Asignacion&action=details&id=<?= htmlspecialchars($asignacion->getASIG_ID()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
                            <a href="?controller=Asignacion&action=updateshow&id=<?= htmlspecialchars($asignacion->getASIG_ID()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Asignacion&action=delete&id=<?= htmlspecialchars($asignacion->getASIG_ID()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de que desea eliminar esta asignación?');"><i class="fa-solid fa-trash-can"></i></a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function filterTable() {
    let input = document.getElementById("searchInput");
    let filter = input.value.toUpperCase();
    let table = document.getElementById("dataTable");
    let tr = table.getElementsByTagName("tr");
    for (let i = 1; i < tr.length; i++) {
        let textValue = tr[i].textContent || tr[i].innerText;
        if (textValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}
</script>
