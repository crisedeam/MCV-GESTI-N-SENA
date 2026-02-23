<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Operativo</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Asignaciones / Coordinación</h1>
            <p>Programación y asignación de instructores a fichas en ambientes.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Buscar asignación...">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Coordinacion&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Asignación
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
                    <th>INSTRUCTOR</th>
                    <th>FICHA</th>
                    <th>AMBIENTE</th>
                    <th>HORARIO</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaCoordinacions)): ?>
                <tr>
                    <td colspan="6" class="empty-table-message">
                        No hay asignaciones registradas todavía. <br>
                        Utilice el botón "Nueva Asignación" para programar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaCoordinacions as $coord): ?>
                    <tr>
                        <td style="font-weight: 500;"><?= htmlspecialchars($coord->getCoord_nombre()) ?></td>
                        <td>---</td>
                        <td><?= htmlspecialchars($coord->getCENTRO_FORMACION_cent_id()) ?></td>
                        <td>---</td>
                        <td><span class="status-active">Activo</span></td>
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
