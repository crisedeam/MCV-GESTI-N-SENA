<div class="view-container">
    <div class="breadcrumb">
        <span>Gestión</span>
        <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
        <span class="active">Inicio</span>
    </div>

    <div class="view-header">
        <div class="view-title-block">
            <h1>Bienvenido, <?= htmlspecialchars($_SESSION['nombre'] ?? 'Coordinador') ?></h1>
            <p>Panel de control principal del sistema de gestión de ambientes SENA.</p>
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="dashboard-grid" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-top: 20px;">
        <div class="stat-card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; display: flex; align-items: center; gap: 15px;">
            <div class="stat-icon" style="background-color: var(--brand-primary-light); color: var(--brand-primary); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                <i class="fa-solid fa-building"></i>
            </div>
            <div class="stat-details">
                <h3 style="margin: 0; font-size: 14px; color: var(--text-secondary); font-weight: 500;">Administración</h3>
                <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-primary);">Gestionar sedes y centros</p>
                <a href="?controller=Sede&action=index" style="color: var(--brand-primary); text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-top: 8px;">Ir a Sedes &rarr;</a>
            </div>
        </div>

        <div class="stat-card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; display: flex; align-items: center; gap: 15px;">
            <div class="stat-icon" style="background-color: var(--warning-bg); color: var(--warning); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                <i class="fa-solid fa-book"></i>
            </div>
            <div class="stat-details">
                <h3 style="margin: 0; font-size: 14px; color: var(--text-secondary); font-weight: 500;">Académico</h3>
                <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-primary);">Programas y títulos</p>
                <a href="?controller=Programa&action=index" style="color: var(--warning); text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-top: 8px;">Ir a Programas &rarr;</a>
            </div>
        </div>

        <div class="stat-card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; display: flex; align-items: center; gap: 15px;">
            <div class="stat-icon" style="background-color: var(--info-bg); color: var(--info); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="stat-details">
                <h3 style="margin: 0; font-size: 14px; color: var(--text-secondary); font-weight: 500;">Ejecución</h3>
                <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-primary);">Instructores e inspección</p>
                <a href="?controller=Instructor&action=index" style="color: var(--info); text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-top: 8px;">Ir a Instructores &rarr;</a>
            </div>
        </div>
        
        <div class="stat-card" style="background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px; display: flex; align-items: center; gap: 15px;">
            <div class="stat-icon" style="background-color: var(--border-color); color: var(--text-tertiary); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0;">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
            <div class="stat-details">
                <h3 style="margin: 0; font-size: 14px; color: var(--text-secondary); font-weight: 500;">Horarios</h3>
                <p style="margin: 5px 0 0; font-size: 14px; color: var(--text-primary);">Gestión de asignaciones</p>
                <a href="?controller=Asignacion&action=index" style="color: var(--text-tertiary); text-decoration: none; font-size: 12px; font-weight: 600; display: inline-block; margin-top: 8px;">Ver Asignaciones &rarr;</a>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div style="margin-top: 30px; background: var(--bg-card); border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 20px;">
        <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 16px; color: var(--text-primary); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Acciones Rápidas</h3>
        <div style="display: flex; gap: 15px; flex-wrap: wrap;">
            <a href="?controller=Ambiente&action=register" class="btn-primary" style="text-decoration: none;"><i class="fa-solid fa-plus"></i> Nuevo Ambiente</a>
            <a href="?controller=Instructor&action=register" class="btn-primary" style="text-decoration: none; background-color: #2563eb; border-color: #2563eb;"><i class="fa-solid fa-plus"></i> Nuevo Instructor</a>
            <a href="?controller=Asignacion&action=register" class="btn-primary" style="text-decoration: none; background-color: #9333ea; border-color: #9333ea;"><i class="fa-solid fa-plus"></i> Nueva Asignación</a>
        </div>
    </div>
</div>
