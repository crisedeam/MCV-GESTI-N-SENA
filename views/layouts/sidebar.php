<?php
// Sidebar layout
$currentController = isset($_GET['controller']) ? $_GET['controller'] : 'Sede';

function isActive($menu, $current) {
    return $menu === $current ? 'class="active"' : '';
}
?>

<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-box">
            S
        </div>
        <div class="logo-text">
            <h2>Gestión</h2>
            <p>SENA AMBIENTES</p>
        </div>
    </div>

    <div class="sidebar-menu">
        <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'coordinador'): ?>
            <div class="menu-group">
                <h3>Administración</h3>
                <ul>
                    <li <?= isActive('Sede', $currentController) ?>><a href="?controller=Sede&action=index"><i class="fa-solid fa-building"></i> Sedes</a></li>
                    <li <?= isActive('CentroFormacion', $currentController) ?>><a href="?controller=CentroFormacion&action=index"><i class="fa-solid fa-city"></i> Centros de Formación</a></li>
                    <li <?= isActive('Coordinacion', $currentController) ?>><a href="?controller=Coordinacion&action=index"><i class="fa-solid fa-sitemap"></i> Coordinaciones</a></li>
                    <li <?= isActive('Ambiente', $currentController) ?>><a href="?controller=Ambiente&action=index"><i class="fa-solid fa-door-open"></i> Ambientes</a></li>
                </ul>
            </div>

            <div class="menu-group">
                <h3>Académico</h3>
                <ul>
                    <li <?= isActive('Programa', $currentController) ?>><a href="?controller=Programa&action=index"><i class="fa-solid fa-book"></i> Programas</a></li>
                    <li <?= isActive('TituloPrograma', $currentController) ?>><a href="?controller=TituloPrograma&action=index"><i class="fa-solid fa-graduation-cap"></i> Títulos</a></li>
                    <li <?= isActive('Competencia', $currentController) ?>><a href="?controller=Competencia&action=index"><i class="fa-solid fa-list-check"></i> Competencias</a></li>
                </ul>
            </div>

            <div class="menu-group">
                <h3>Ejecución</h3>
                <ul>
                    <li <?= isActive('Instructor', $currentController) ?>><a href="?controller=Instructor&action=index"><i class="fa-solid fa-chalkboard-user"></i> Instructores</a></li>
                    <li <?= isActive('Ficha', $currentController) ?>><a href="?controller=Ficha&action=index"><i class="fa-solid fa-users-viewfinder"></i> Fichas</a></li>
                    <li <?= isActive('Asignacion', $currentController) ?>><a href="?controller=Asignacion&action=index"><i class="fa-solid fa-calendar-days"></i> Asignaciones</a></li>
                    <li <?= isActive('InstruCompetencia', $currentController) ?>><a href="?controller=InstruCompetencia&action=index"><i class="fa-solid fa-list-ul"></i> Competencias Instructor</a></li>
                </ul>
            </div>
        <?php elseif (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor'): ?>
            <div class="menu-group">
                <h3>Mi Espacio</h3>
                <ul>
                    <li <?= isActive('Sede', $currentController) ?>><a href="?controller=Sede&action=index"><i class="fa-solid fa-house-user"></i> Inicio</a></li>
                    <li <?= isActive('Asignacion', $currentController) ?>><a href="?controller=Asignacion&action=index"><i class="fa-solid fa-calendar-check"></i> Mi Horario</a></li>
                </ul>
            </div>
        <?php endif; ?>
    </div>

    <div class="sidebar-footer">
        <button class="btn-config">
            <i class="fa-solid fa-gear"></i> Configuración
        </button>
        <div class="user-profile">
            <div class="user-avatar">
                <div class="avatar-placeholder" style="width: 32px; height: 32px; background: #39A900; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: bold; font-size: 14px;">CR</div>
            </div>
            <div class="user-info">
                <h4 style="margin: 0; font-size: 14px; color: #111827;"><?= isset($_SESSION['nombre']) ? htmlspecialchars($_SESSION['nombre']) : 'Usuario' ?></h4>
                <p style="margin: 0; font-size: 12px; color: #6b7280; text-transform: capitalize;"><?= isset($_SESSION['rol']) ? htmlspecialchars($_SESSION['rol']) : 'Rol' ?></p>
            </div>
            <a href="?controller=Auth&action=logout" class="btn-logout" title="Cerrar sesión" style="background: none; border: none; font-size: 18px; color: #9ca3af; cursor: pointer; text-decoration: none; padding: 0;">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
            </a>
        </div>
    </div>
</aside>
