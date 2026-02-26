<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Infraestructura</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Centros de Formación</h1>
            <p>Administración de los centros de formación por regionales.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar centro..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=CentroFormacion&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Centro
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Este Centro de Formación no puede ser eliminado porque tiene <b>Instructores o Coordinaciones</b> dependientes. Por favor, elimine primero los registros vinculados a este centro.
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
                <i class="fa-solid fa-school"></i>
            </div>
            <div class="stat-details">
                <h3>Centros</h3>
                <p class="stat-number"><?php echo $totalCentros ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fef3c7; color: #d97706;">
                <i class="fa-solid fa-chalkboard"></i>
            </div>
            <div class="stat-details">
                <h3>Cobertura</h3>
                <p class="stat-number">Regional</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID CENTRO</th>
                    <th>NOMBRE DEL CENTRO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaCentros)): ?>
                <tr>
                    <td colspan="3" class="empty-table-message">
                        No hay centros de formación registrados todavía. <br>
                        Utilice el botón "Nuevo Centro" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaCentros as $centro): ?>
                    <tr>
                        <td><?= htmlspecialchars($centro->getCent_id()) ?></td>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif;"><?= htmlspecialchars($centro->getCent_nombre()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=CentroFormacion&action=details&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=CentroFormacion&action=updateshow&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=CentroFormacion&action=delete&id=<?= htmlspecialchars($centro->getCent_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar este registro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/CentroFormacion/show.js"></script>
