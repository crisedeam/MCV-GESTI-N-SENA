<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Académico</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Titulación</h1>
            <p>Gestión de los títulos o niveles de formación asociados.</p>
        </div>
        <div class="header-actions">
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar título..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=TituloPrograma&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nueva Titulación
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Este Título de Programa no puede ser eliminado porque tiene <b>Programas</b> dependientes. Por favor, elimine primero los Programas vinculados a este título.
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
                <i class="fa-solid fa-graduation-cap"></i>
            </div>
            <div class="stat-details">
                <h3>Titulaciones</h3>
                <p class="stat-number"><?php echo $totalTituloProgramas ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #fef3c7; color: #d97706;">
                <i class="fa-solid fa-certificate"></i>
            </div>
            <div class="stat-details">
                <h3>Certificación</h3>
                <p class="stat-number">Activa</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>CÓDIGO DE TITULACIÓN</th>
                    <th>DENOMINACIÓN</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaTituloProgramas)): ?>
                <tr>
                    <td colspan="3" class="empty-table-message">
                        No hay certificaciones o títulos registrados todavía. <br>
                        Utilice el botón "Nueva Titulación" para agregar una.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaTituloProgramas as $titulo): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($titulo->getTitpro_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($titulo->getTitpro_nombre()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=TituloPrograma&action=details&id=<?= htmlspecialchars($titulo->getTitpro_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=TituloPrograma&action=updateshow&id=<?= htmlspecialchars($titulo->getTitpro_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=TituloPrograma&action=delete&id=<?= htmlspecialchars($titulo->getTitpro_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/TituloPrograma/show.js"></script>
