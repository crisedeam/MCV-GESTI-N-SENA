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
                <input type="text" placeholder="Buscar ficha...">
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
                    <strong>No se pudo eliminar:</strong> La ficha no puede ser eliminada porque tiene registros asociados (ej. asignaciones de ambientes o instructores).
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
                    <th>CÓDIGO DE FICHA</th>
                    <th>PROGRAMA DE FORMACIÓN</th>
                    <th>CANTIDAD APRENDICES</th>
                    <th>ESTADO</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaFichas)): ?>
                <tr>
                    <td colspan="5" class="empty-table-message">
                        No hay fichas registradas todavía. <br>
                        Utilice el botón "Nueva Ficha" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaFichas as $ficha): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($ficha->getFich_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($ficha->getPROGRAMA_prog_id()) ?></td>
                        <td><?= htmlspecialchars($ficha->getFich_jornada()) ?></td>
                        <td><span class="status-active">Activa</span></td>
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
