<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Talento Humano</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Instructores</h1>
            <p>Administración del personal docente e instructores.</p>
        </div>
        <div class="header-actions">
            <!-- DEBUG INFO TEMPORAL -->
            <div style="background:#fff; border:1px solid red; padding:5px; font-size:12px;">
                CENTRO ID ACTIVO: <?php echo isset($_SESSION['centro_id']) ? $_SESSION['centro_id'] : 'NO DEFINIDO'; ?>
            </div>
            
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Buscar instructor..." onkeyup="filterTable()">
            </div>
            <button class="btn-notifications">
                <i class="fa-regular fa-bell"></i>
            </button>
            <a href="?controller=Instructor&action=register" class="btn-primary" style="text-decoration: none;">
                <i class="fa-solid fa-plus"></i> Nuevo Instructor
            </a>
        </div>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div style="background-color: #fee2e2; border-left: 4px solid #ef4444; color: #b91c1c; padding: 1rem; margin-bottom: 1.5rem; border-radius: 4px; font-family: 'Outfit', sans-serif; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <div>
                <?php if ($_GET['error'] == 'foreign_key'): ?>
                    <strong>No se pudo eliminar:</strong> Este Instructor no puede ser eliminado porque tiene <b>Fichas</b> dependientes (es Instructor Líder). Por favor, asigne otro instructor a esas Fichas o elimínelas primero.
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
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="stat-details">
                <h3>Total Instructores</h3>
                <p class="stat-number"><?php echo $totalInstructores ?? 0; ?></p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background-color: #e0e7ff; color: #4f46e5;">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="stat-details">
                <h3>Permisos de Acceso</h3>
                <p class="stat-number">Instructores Base</p>
            </div>
        </div>
    </div>

    <div class="table-card">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>ID INSTRUCTOR</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>CORREO</th>
                    <th>TELÉFONO</th>
                    <th>ID CENTRO FORMACIÓN</th>
                    <th style="text-align: right;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listaInstructores)): ?>
                <tr>
                    <td colspan="7" class="empty-table-message">
                        No hay instructores registrados todavía. <br>
                        Utilice el botón "Nuevo Instructor" para agregar uno.
                    </td>
                </tr>
                <?php else: ?>
                    <?php foreach ($listaInstructores as $instructor): ?>
                    <tr>
                        <td style="font-weight: 500; font-family: 'Outfit', sans-serif; color: #39A900;"><?= htmlspecialchars($instructor->getInst_id()) ?></td>
                        <td style="font-weight: 500;"><?= htmlspecialchars($instructor->getInst_nombre()) ?></td>
                        <td><?= htmlspecialchars($instructor->getInst_apellido()) ?></td>
                        <td><?= htmlspecialchars($instructor->getInst_correo()) ?></td>
                        <td><?= htmlspecialchars($instructor->getInst_telefono()) ?></td>
                        <td><?= htmlspecialchars($instructor->getCENTRO_FORMACION_cent_id()) ?></td>
                        <td style="text-align: right;">
                            <a href="?controller=Instructor&action=fichas&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon" title="Ver Fichas Asignadas" style="color: var(--brand-secondary);"><i class="fa-solid fa-users-rectangle"></i></a>
                            <a href="?controller=Instructor&action=details&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon" title="Ver Detalles"><i class="fa-regular fa-eye"></i></a>
                            <a href="?controller=Instructor&action=updateshow&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon" title="Editar"><i class="fa-solid fa-pen"></i></a>
                            <a href="?controller=Instructor&action=delete&id=<?= htmlspecialchars($instructor->getInst_id()) ?>" class="btn-icon delete-icon" title="Eliminar" onclick="return confirm('¿Está seguro de eliminar?');"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="assets/js/Instructor/show.js"></script>
