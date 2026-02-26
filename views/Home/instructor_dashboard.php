<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - SENA</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php lcg_value(); $vs = '?v=' . time(); ?>
    <link rel="stylesheet" href="assets/css/main.css<?= $vs ?>">
    <link rel="stylesheet" href="assets/css/sidebar.css<?= $vs ?>">
</head>
<body class="light-theme">

    <?php 
    $currentController = 'Home';
    include 'views/layouts/sidebar.php'; 
    ?>

    <main class="main-content">
        <div class="view-container">
            <div class="breadcrumb">
                <span>Mi Espacio</span>
                <i class="fa-solid fa-chevron-right" style="font-size: 10px;"></i>
                <span class="active">Inicio</span>
            </div>

    <!-- Instructor Welcome Header -->
    <div class="view-header" style="background: linear-gradient(135deg, #39A900 0%, #2f8a00 100%); color: white; padding: 40px 30px; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 10px 15px -3px rgba(57,169,0,0.3); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div class="view-title-block" style="display: flex; align-items: center; gap: 20px; border: none; padding: 0;">
            <div style="background: rgba(255,255,255,0.2); width: 80px; height: 80px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; font-weight: bold; border: 2px solid rgba(255,255,255,0.4);">
                <?= strtoupper(substr($_SESSION['nombre'] ?? 'I', 0, 1)) ?>
            </div>
            <div>
                <h1 style="color: white; margin: 0 0 8px 0; font-size: 28px; line-height: 1.2;">Hola, <?= htmlspecialchars($_SESSION['nombre'] ?? 'Instructor') ?></h1>
                <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 16px;">Bienvenido a tu portal de gestión de ambientes y horarios del SENA.</p>
            </div>
        </div>
        <div style="background: rgba(255,255,255,0.1); padding: 15px 25px; border-radius: 8px; backdrop-filter: blur(5px);">
            <div style="font-size: 14px; color: rgba(255,255,255,0.8); margin-bottom: 5px;">Fecha Actual</div>
            <div style="font-size: 18px; font-weight: bold;"><?= date('d M Y') ?></div>
        </div>
    </div>

    <!-- Features Grid -->
    <div class="dashboard-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
        
        <!-- Card 1: Mi Horario -->
        <div class="stat-card" style="background: var(--bg-card); border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 25px; transition: transform 0.2s, box-shadow 0.2s; border-top: 4px solid var(--brand-primary);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.05)';">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                <div style="background-color: var(--brand-primary-light); color: var(--brand-primary); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: var(--text-primary);">Mi Horario</h3>
            <p style="margin: 0 0 20px 0; font-size: 14px; color: var(--text-secondary); line-height: 1.5;">Consulta tus asignaciones vigentes organizadas en el calendario mensual.</p>
            <a href="?controller=Asignacion&action=index" class="btn-primary" style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; border-radius: 8px; padding: 10px;"><i class="fa-regular fa-calendar"></i> Ver Mi Calendario</a>
        </div>

        <!-- Card 2: Perfil Funcional -->
        <div class="stat-card" style="background: var(--bg-card); border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 25px; transition: transform 0.2s, box-shadow 0.2s; border-top: 4px solid var(--info);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 10px 15px rgba(0,0,0,0.1)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.05)';">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                <div style="background-color: var(--info-bg); color: var(--info); width: 45px; height: 45px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 20px;">
                    <i class="fa-solid fa-list-check"></i>
                </div>
            </div>
            <h3 style="margin: 0 0 10px 0; font-size: 18px; color: var(--text-primary);">Mis Competencias</h3>
            <p style="margin: 0 0 20px 0; font-size: 14px; color: var(--text-secondary); line-height: 1.5;">Próximamente podrás revisar las competencias que tienes habilitadas para impartir formación.</p>
            <button class="btn-primary" style="text-decoration: none; display: flex; align-items: center; justify-content: center; gap: 8px; width: 100%; background-color: var(--border-color); border-color: var(--border-color); color: var(--text-tertiary); cursor: not-allowed; border-radius: 8px; padding: 10px;" disabled><i class="fa-solid fa-lock"></i> Próximamente</button>
        </div>
    </div>
    
    <!-- Info Banner -->
    <div style="margin-top: 30px; background: var(--bg-card); border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); padding: 25px; display: flex; align-items: center; gap: 20px;">
        <div style="font-size: 40px; color: var(--warning); flex-shrink: 0;">
            <i class="fa-regular fa-lightbulb"></i>
        </div>
        <div>
            <h4 style="margin: 0 0 5px 0; color: var(--text-primary); font-size: 16px;">Recordatorio</h4>
            <p style="margin: 0; color: var(--text-secondary); font-size: 14px; line-height: 1.5;">Tus asignaciones son gestionadas por coordinación académica. Si detectas alguna inconsistencia en tu horario o necesitas notificar una novedad, por favor contacta a tu coordinador de área.</p>
        </div>
    </div>
</div>
</main>
<script src="assets/js/Home/instructor_dashboard.js<?= $vs ?>"></script>
</body>
</html>
