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
    <!-- Auth CSS -->
    <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body>

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

</body>
</html>
