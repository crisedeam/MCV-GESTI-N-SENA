<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENA - Gestión de Ambientes</title>
    <!-- General Layout CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <!-- Sidebar CSS -->
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <!-- Views CSS -->
    <link rel="stylesheet" href="assets/css/views.css">
    <!-- Forms CSS -->
    <link rel="stylesheet" href="assets/css/forms.css">
    <!-- Icons (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="main-container">
        <!-- Sidebar -->
        <?php include_once 'views/layouts/sidebar.php'; ?>

        <!-- Main Content Area where views will be loaded -->
        <main class="content-area">
            <?php
            // Requerir nuestra lógica de enrutamiento principal
            require_once 'routing.php';
            ?>
        </main>
    </div>

</body>
</html>
