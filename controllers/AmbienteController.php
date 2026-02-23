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
        // TAREA:
        // - Verifica si llegaron por $_POST los campos: amb_id, amb_nombre y SEDE_sede_id
        // - Instancia un nuevo objeto Ambiente con esos datos.
        // - Invoca Ambiente::save($tuObjeto).
        // - Redirige a header('Location: ?controller=Ambiente&action=index');
    }

    // 4. Mostrar detalles
    public function details() {
        // TAREA:
        // - Verifica el $_GET['id'].
        // - Usa Ambiente::searchById().
        // - Haz require_once de 'details.php'.
    }

    // 5. Mostrar formulario de edición
    public function updateshow() {
        // TAREA:
        // - Verifica el $_GET['id'] y búscalo con searchById().
        // - Haz require_once de 'updateshow.php'.
    }

    // 6. Procesar edición
    public function update() {
        // TAREA:
        // - Captura el $_POST de ID, Nombre de ambiente y la FORÁNEA.
        // - Instancia un objeto Ambiente nuevo.
        // - Invoca Ambiente::update($tuObjeto).
        // - Redirige al action=index.
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
