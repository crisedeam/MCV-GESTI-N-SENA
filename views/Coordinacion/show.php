<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Operativo</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Coordinación</h1>
            <p>Programación y coordinación.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar coordinación..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Coordinacion&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Coordinación
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Esta Coordinación no puede ser eliminada porque tiene <b>Fichas</b> dependientes. Por favor, asigne otra coordinación a esas Fichas o elimínelas primero.
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
                <i class="fa-solid fa-sitemap"></i>
            </div>
            <div class="stat-details">
                <h3>Coordinaciones</h3>
                <p class="stat-number"><?php echo $totalCoordinaciones ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fef3c7; color: #d97706;">
                <i class="fa-solid fa-star"></i>
            </div>
            <div class="stat-details">
                <h3>Permisos</h3>
                <p class="stat-number">Administrador</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID COORDINACIÓN</th>
                    <th>DESCRIPCIÓN</th>
                    <th>COORDINADOR</th>
                    <th>CORREO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaCoordinacions)): ?>
                <tr>
                    <td colspan="5" class="empty-table-message">
                        No hay coordinaciones registradas todavía. <br>
                        Utilice el botón "Nueva Coordinación" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaCoordinacions as $coord): ?>
                    <tr>
                        <td style="font-weight: 500; color: #39A900;"><?= htmlspecialchars($coord->getCoord_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($coord->getCoord_descripcion()) ?></td>
                        <td><?= htmlspecialchars($coord->getCoord_nombre_coordinador()) ?></td>
                        <td><?= htmlspecialchars($coord->getCoord_correo()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=Coordinacion&action=details&id=<?= htmlspecialchars($coord->getCoord_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Coordinacion&action=updateshow&id=<?= htmlspecialchars($coord->getCoord_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Coordinacion&action=delete&id=<?= htmlspecialchars($coord->getCoord_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/Coordinacion/show.js"></script>
