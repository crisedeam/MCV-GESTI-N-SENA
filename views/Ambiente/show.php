<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Infraestructura</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Ambientes</h1>
            <p>Administración de espacios físicos para la formación.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar ambiente..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Ambiente&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Ambiente
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Este Ambiente no puede ser eliminado porque tiene <b>Asignaciones/Coordinaciones</b> dependientes. Por favor, elimine primero las programaciones vinculadas a este ambiente.
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
                <i class="fa-solid fa-door-open"></i>
            </div>
            <div class="stat-details">
                <h3>Total Ambientes</h3>
                <p class="stat-number"><?php echo $totalAmbientes ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                <i class="fa-solid fa-building"></i>
            </div>
            <div class="stat-details">
                <h3>Infraestructura</h3>
                <p class="stat-number">Activa</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID AMBIENTE</th>
                    <th>NOMBRE DEL AMBIENTE</th>
                    <th>ID SEDE (FORÁNEA)</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaAmbientes)): ?>
                <tr>
                    <td colspan="4" class="empty-table-message">
                        No hay ambientes registrados todavía. <br>
                        Utilice el botón "Nuevo Ambiente" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaAmbientes as $ambiente): ?>
                    <tr>
                        <td><?= htmlspecialchars($ambiente->getAmb_id()) ?></td>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($ambiente->getAmb_nombre()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($ambiente->getSEDE_sede_id()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=Ambiente&action=details&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Ambiente&action=updateshow&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Ambiente&action=delete&id=<?= htmlspecialchars($ambiente->getAmb_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/Ambiente/show.js"></script>
