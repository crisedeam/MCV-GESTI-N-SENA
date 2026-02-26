<?php
// ¡Hola! Este es tu primer Controlador.
// El Controlador es como el "Director de Orquesta" en el patrón MVC (Modelo-Vista-Controlador).
// Su trabajo es muy sencillo:
// 1. Recibe la petición del usuario (ej: "Quiero ver las sedes" o "Quiero guardar esta sede").
// 2. Le pide los datos al Modelo (Sede.php) si es necesario.
// 3. Le pasa esos datos a la Vista (ej: show.php o register.php) para mostrarlos en pantalla.

require_once 'models/Sede.php'; // Siempre requerimos el modelo que vamos a controlar

class SedeController {
    
    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'centro_formacion') {
            header('Location: ?controller=Home&action=index');
            exit;
        }
    }

    // ---------------------------------------------------------
    // ACCIÓN: Mostrar la vista principal (La tabla de registros)
    // ---------------------------------------------------------
    public function index() { 
        // 1. Le pedimos al Modelo "Sede" que nos traiga TODAS las sedes de la base de datos
        // usando la función estática all() que creaste en Sede.php
        $sedes = Sede::all();
        $totalSedes = count($sedes);
        
        // 2. Cargamos la vista "show.php" para mostrar la tabla.
        // Al incluir la vista aquí, la variable $sedes estará disponible dentro de show.php
        // para que puedas hacer un ciclo (foreach) y dibujar la tabla.
        require_once 'views/Sede/show.php';
    }

    // ---------------------------------------------------------
    // ACCIÓN: Mostrar el formulario para Registrar
    // ---------------------------------------------------------
    public function register() {
        // En este caso, solo necesitamos mostrar el formulario vacío.
        // No necesitamos pedirle nada a la base de datos por ahora.
        require_once 'views/Sede/register.php';
    }

    // ---------------------------------------------------------
    // ACCIÓN: Procesar y Guardar los datos del formulario
    // ---------------------------------------------------------
    public function save() {
        // Esta función se ejecuta cuando el usuario hace clic en el botón "Guardar" del formulario.
        // El formulario te envía los datos por el método POST ($_POST).
        
        // Verificamos que sí esté llegando el sede_nombre desde el formulario
        if(isset($_POST['sede_nombre']) && isset($_POST['sede_id'])){
            // Creamos un nuevo objeto (instancia) del modelo Sede.
            // Le pasamos el ID manual y el nombre.
            $nuevaSede = new Sede($_POST['sede_id'], $_POST['sede_nombre']);
            
            // Usamos la función save() de tu modelo para insertarlo en la base de datos.
            Sede::save($nuevaSede);
            
            // Una vez guardado, redirigimos al usuario de vuelta a la tabla principal
            header('Location: ?controller=Sede&action=index');
        } else {
             // Si por alguna razón llegó vacío, enviamos un error o redirigimos de vuelta
            header('Location: ?controller=Sede&action=register');
        }
    }

    // ---------------------------------------------------------
    // ACCIÓN: Mostrar los detalles de UN solo registro
    // ---------------------------------------------------------
    public function details() {
        // Esta acción espera recibir un ID por la URL (ej: ?controller=Sede&action=details&id=5)
        if(isset($_GET['id'])){
            // Usamos tu función searchById para encontrar esa sede específica
            $sede = Sede::searchById($_GET['id']);
            
            // Cargamos la vista de detalles. La variable $sede estará disponible en la vista.
            require_once 'views/Sede/details.php';
        } else {
            // Si no hay ID, lo devolvems a la tabla
            header('Location: ?controller=Sede&action=index');
        }
    }

    // ---------------------------------------------------------
    // ACCIÓN: Mostrar el formulario para Actualizar
    // ---------------------------------------------------------
    public function updateshow() {
        // Parecido a details(), necesitamos saber qué sede vamos a editar
        if(isset($_GET['id'])){
            $sede = Sede::searchById($_GET['id']);
            // Cargamos el formulario updateshow.php
            // En ese archivo usarás la variable $sede para llenar los <input> con los datos actuales
            require_once 'views/Sede/updateshow.php';
        } else {
            header('Location: ?controller=Sede&action=index');
        }
    }

    // ---------------------------------------------------------
    // ACCIÓN: Procesar y Actualizar los datos del formulario
    // ---------------------------------------------------------
    public function update() {
        // Este se ejecuta al dar clic en "Actualizar Sede" en el formulario updateshow.php
        // Debe recibir tanto el ID como el nuevo Nombre
        if(isset($_POST['sede_id']) && isset($_POST['sede_nombre'])){
            
            // Creamos una instancia con los nuevos datos
            $sedeActualizada = new Sede($_POST['sede_id'], $_POST['sede_nombre']);
            
            // Mandamos a actualizar usando tu función update()
            Sede::update($sedeActualizada);
            
            // Redirigimos a la tabla
            header('Location: ?controller=Sede&action=index');
        }
    }

    // ---------------------------------------------------------
    // ACCIÓN: Eliminar un registro
    // ---------------------------------------------------------
    public function delete() {
        if(isset($_GET['id'])){
            try {
                // Mandamos a borrar el registro
                Sede::delete($_GET['id']);
                // Siempre volvemos a la tabla al terminar
                header('Location: ?controller=Sede&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Sede&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Sede&action=index&error=general');
                }
            }
        } else {
            header('Location: ?controller=Sede&action=index');
        }
    }
}
?>
