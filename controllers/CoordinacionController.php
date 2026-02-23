<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Coordinacion
// =========================================================================
// Tu misión, si decides aceptarla, es programar los siguientes métodos 
// guiándote por el ejemplo que hicimos en SedeController.php.
// 
// RECUERDA: 
// - Las vistas de este módulo están en views/Coordinacion/
// - El modelo espera que devuelvas o recibas objetos de su propia clase.
// =========================================================================

require_once 'models/Coordinacion.php';

class CoordinacionController {

    // 1. Mostrar la tabla de registros
    public function index() {
        static $listaCoordinacions = [];
        $listaCoordinacions = Coordinacion::all();
        require_once    'views/Coordinacion/show.php';
        // TAREA:
        // - Llama al método estático all() de tu modelo para traer todos los registros.
        // - Guarda eso en una variable.
        // - Haz un require_once de la vista 'show.php' correspondiente.
    }

    // 2. Mostrar formulario vacío para registrar
    public function register() {
        require_once 'views/Coordinacion/register.php';
        // TAREA:
        // - Simplemente haz require_once de la vista 'register.php' correspondiente.
    }

    // 3. Procesar los datos y guardarlos
    public function save() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $coordinacion = new Coordinacion($_POST['coord_id'], $_POST['coord_nombre'], $_POST['CENTRO_FORMACION_cent_id']);
            Coordinacion::save($coordinacion);
            header('Location: ?controller=Coordinacion&action=index');
        }
        // TAREA:
        // - Verifica si llegaron por $_POST el ID y los demás campos requeridos.
        // - Instancia un nuevo objeto Coordinacion con esos datos.
        // - Invoca el método estático save() de tu modelo pasándole el objeto.
        // - Si todo sale bien, redirige usando header('Location: ?controller=Coordinacion&action=index');
    }

    // 4. Mostrar detalles de un registro
    public function details() {
        $coordinacion = Coordinacion::searchById($_GET['id']);
        require_once 'views/Coordinacion/details.php';
        // TAREA:
        // - Verifica si llegó un ID por la URL ($_GET['id']).
        // - Si llegó, usa searchById() del modelo y guárdalo en una variable.
        // - Haz require_once de 'details.php'.
    }

    // 5. Mostrar formulario para actualizar
    public function updateshow() {
        $coordinacion = Coordinacion::searchById($_GET['id']);
        require_once 'views/Coordinacion/updateshow.php';
        // TAREA:
        // - Igual que details(), verifica el $_GET['id'].
        // - Usa searchById() del modelo y guárdalo en una variable.
        // - Haz require_once de 'updateshow.php'. Esto servirá para que la vista rellene los <input>.
    }

    // 6. Procesar actualización en la BD
    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $coordinacion = new Coordinacion($_POST['coord_id'], $_POST['coord_nombre'], $_POST['CENTRO_FORMACION_cent_id']);
            Coordinacion::update($coordinacion);
            header('Location: ?controller=Coordinacion&action=index');
        }
        // TAREA:
        // - Verifica si llegaron TODOS los campos del formulario por $_POST.
}
?>
