<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Infraestructura</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Sedes</h1>
            <p>Administración de infraestructuras y centros de formación institucional.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar sede, instructor...">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Sede&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Sede
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> El registro no puede ser eliminado porque tiene otros registros asociados o dependientes.
                <?php else: ?>
                    <strong>Error:</strong> Ocurrió un error al intentar eliminar el registro.
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>NOMBRE DE SEDE</th>
                    <th>UBICACIÓN</th>
                    <th>DIRECTOR DE SEDE</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
                <?php if (empty($sedes)): ?>
                <tr>
                    <td colspan="5" class="empty-table-message">
                        No hay sedes registradas todavía. <br>
                        Utilice el botón "Nueva Sede" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($sedes as $sedeItem): ?>
                    <tr>
                        <td style="font-weight: 500;"><?= htmlspecialchars($sedeItem->getSede_nombre()) ?></td>
                        <td>---</td>
                        <td>---</td>
                        <td><span class="status-active">Activo</span></td>
                        <td style="text-align: right;">
                            <a href="?controller=Sede&action=details&id=<?= htmlspecialchars($sedeItem->getSede_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Sede&action=updateshow&id=<?= htmlspecialchars($sedeItem->getSede_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Sede&action=delete&id=<?= htmlspecialchars($sedeItem->getSede_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar esta Sede?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="bottom-grid">
        <div class="map-card">
            <div class="map-overlay">
                <h3>Mapa de Sedes</h3>
                <p>Ubicaciones activas en el territorio nacional.</p>
            </div>
        </div>
        <div class="stats-card">
            <div class="stats-icon">
                <i class="fa-solid fa-chart-simple"></i>
            </div>
            <div class="stats-title">
                <h3>Resumen de Ocupación</h3>
                <p>Capacidad total instalada</p>
            </div>
            <div class="stats-value">
                0%
            </div>
            <div class="progress-bar-container">
                <div class="progress-bar-fill" style="width: 0%;"></div>
            </div>
        </div>
    </div>
</div>
