<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Operativo</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Fichas</h1>
            <p>Control de grupos de aprendices en formación.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar ficha..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Ficha&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Ficha
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> La Ficha no puede ser eliminada porque tiene otros registros dependiendo de ella en el sistema. asignaciones de ambientes o instructores).
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
                <i class="fa-solid fa-users-viewfinder"></i>
            </div>
            <div class="stat-details">
                <h3>Total Fichas</h3>
                <p class="stat-number"><?= $totalFichas ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fce7f3; color: #db2777;">
                <i class="fa-solid fa-sun"></i>
            </div>
            <div class="stat-details">
                <h3>Jornada Diurna</h3>
                <p class="stat-number"><?= $totalDiurnas ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                <i class="fa-solid fa-moon"></i>
            </div>
            <div class="stat-details">
                <h3>Jornada Nocturna</h3>
                <p class="stat-number"><?= $totalNocturnas ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fef3c7; color: #d97706;">
                <i class="fa-solid fa-circle-half-stroke"></i>
            </div>
            <div class="stat-details">
                <h3>Jornada Mixta</h3>
                <p class="stat-number"><?= $totalMixtas ?></p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>CÓDIGO DE FICHA</th>
                    <th>PROGRAMA DE FORMACIÓN</th>
                    <th>INSTRUCTOR LÍDER</th>
                    <th>JORNADA</th>
                    <th>COORDINACIÓN</th>
                    <th>FECHA INICIO</th>
                    <th>FECHA FIN</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaFichas)): ?>
                <tr>
                    <td colspan="8" class="empty-table-message">
                        No hay fichas registradas todavía. <br>
                        Utilice el botón "Nueva Ficha" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaFichas as $ficha): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($ficha->getFich_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($ficha->getPROGRAMA_prog_id()) ?></td>
                        <td><?= htmlspecialchars($ficha->getINSTRUCTOR_inst_id_lider()) ?></td>
                        <td><?= htmlspecialchars($ficha->getFich_jornada()) ?></td>
                        <td><?= htmlspecialchars($ficha->getCOORDINACION_coord_id()) ?></td>
                        <td><?= htmlspecialchars($ficha->getFich_fecha_ini_lectiva()) ?></td>
                        <td><?= htmlspecialchars($ficha->getFich_fecha_fin_lectiva()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=Ficha&action=details&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Ficha&action=updateshow&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Ficha&action=delete&id=<?= htmlspecialchars($ficha->getFich_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/Ficha/show.js"></script>
