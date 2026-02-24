<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: Ambiente
// =========================================================================
// Tu misión, si decides aceptarla, es programar los siguientes métodos 
// guiándote por el ejemplo que hicimos en SedeController.php.
// 
// RECUERDA: 
// - Las vistas de este módulo están en views/Ambiente/
// - Este controlador es especial porque maneja llaves foráneas. Al enviar datos
//   asegúrate de incluir el ID de la Sede seleccionada en el menú desplegable.
// =========================================================================

require_once 'models/Ambiente.php';

class AmbienteController {

    // 1. Mostrar la tabla de registros
    public function index() {
        static $listaAmbientes = [];
        $listaAmbientes = Ambiente::all();
        $totalAmbientes = count($listaAmbientes);
        require_once 'views/Ambiente/show.php';
        // TAREA:
        // - Llama al método estático all() de tu modelo para traer todos los registros.
        // - Guarda eso en una variable.
        // - Haz un require_once de la vista 'show.php'.
    }

    // 2. Mostrar formulario vacío para registrar
    public function register() {
        require_once 'views/Ambiente/register.php';
        // TAREA:
        // - Haz require_once de la vista 'register.php'.
        // (Nota: la vista register.php ya incluye connection.php para traer la lista de sedes).
    }

    // 3. Procesar los datos y guardarlos
    public function save() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ambiente = new Ambiente($_POST['amb_id'], $_POST['amb_nombre'], $_POST['SEDE_sede_id']);
            Ambiente::save($ambiente);
            header('Location: ?controller=Ambiente&action=index');
        }
    }

    // 4. Mostrar detalles
    public function details() {
        $ambiente = Ambiente::searchById($_GET['id']);
        require_once 'views/Ambiente/details.php';
    }

    // 5. Mostrar formulario de edición
    public function updateshow() {
        $ambiente = Ambiente::searchById($_GET['id']);
        require_once 'views/Ambiente/updateshow.php';
    }

    // 6. Procesar edición
    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $ambiente = new Ambiente($_POST['amb_id'], $_POST['amb_nombre'], $_POST['SEDE_sede_id']);
            Ambiente::update($ambiente);
            header('Location: ?controller=Ambiente&action=index');
        }
    }

    // 7. Eliminar
    public function delete() {
        if(isset($_GET['id'])){
            try {
                // $ambiente = Ambiente::searchById($_GET['id']);
                Ambiente::delete($_GET['id']);
                header('Location: ?controller=Ambiente&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Ambiente&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Ambiente&action=index&error=general');
                }
            }
        } else {
            header('Location: ?controller=Ambiente&action=index');
        }
    }
}
?>
