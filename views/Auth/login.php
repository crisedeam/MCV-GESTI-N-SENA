<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SENA</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <?php $vs = '?v=' . time(); ?>
    <link rel="stylesheet" href="assets/css/main.css<?= $vs ?>">
    <link rel="stylesheet" href="assets/css/auth.css<?= $vs ?>">
</head>
<body style="position: relative;">

    <button type="button" id="themeToggleBtn" style="position: absolute; top: 20px; right: 20px; background: var(--bg-card); color: var(--text-primary); border: 1px solid var(--border-color); padding: 8px 16px; border-radius: 20px; cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: 'Outfit', sans-serif; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); transition: all 0.2s; z-index: 9999;">
        <i class="fa-solid fa-moon"></i> Oscuro
    </button>

    <div class="login-container">
        <div class="logo-container">
            <!-- Asumiendo que hay un logo en la ruta. Ajusta si es necesario -->
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/83/Sena_Colombia_logo.svg/1024px-Sena_Colombia_logo.svg.png" alt="SENA Logo">
        </div>
        
        <h2>Bienvenido</h2>
        <p class="subtitle">Ingrese al Sistema de Gestión de Ambientes</p>

        <?php if (isset($_GET['error']) && $_GET['error'] == 'invalid_credentials'): ?>
            <div class="error-message">
                <i class="fa-solid fa-circle-exclamation"></i>
                Correo o contraseña incorrectos.
            </div>
        <?php endif; ?>

        <form action="?controller=Auth&action=authenticate" method="POST">
            <div class="form-group">
                <label for="correo">Correo Electrónico</label>
                <div class="input-group">
                    <i class="fa-regular fa-envelope"></i>
                    <input type="email" id="correo" name="correo" placeholder="ejemplo@sena.edu.co" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="password" name="password" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>

    <!-- MODO OSCURO (DARK THEME) SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeToggleBtn = document.getElementById('themeToggleBtn');
            const currentTheme = localStorage.getItem('theme');

            if (currentTheme) {
                document.body.classList.add(currentTheme);
                if (currentTheme === 'dark-theme' && themeToggleBtn) {
                    themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Claro';
                }
            }

            if(themeToggleBtn) {
                themeToggleBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    document.body.classList.toggle('dark-theme');
                    // Ensure light-theme is removed if it was present
                    document.body.classList.remove('light-theme');
                    
                    let theme = 'light-theme';
                    
                    if (document.body.classList.contains('dark-theme')) {
                        theme = 'dark-theme';
                        themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun"></i> Claro';
                    } else {
                        themeToggleBtn.innerHTML = '<i class="fa-solid fa-moon"></i> Oscuro';
                        document.body.classList.add('light-theme');
                    }
                    
                    localStorage.setItem('theme', theme);
                });
            }
        });
    </script>
</body>
</html>
