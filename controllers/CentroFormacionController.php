<?php
// =========================================================================
// CONTROLADOR PARA EL MODELO: CentroFormacion
// =========================================================================
// Tu misión, si decides aceptarla, es programar los siguientes métodos 
// guiándote por el ejemplo que hicimos en SedeController.php.
// 
// RECUERDA: 
// - Las vistas de este módulo están en views/CentroFormacion/
// - El modelo espera que devuelvas o recibas objetos de su propia clase.
// =========================================================================

require_once 'models/CentroFormacion.php';

class CentroFormacionController {

    // 1. Mostrar la tabla de registros
    public function index() {
        static $listaCentros = [];
        $listaCentros = CentroFormacion::all();
        require_once 'views/CentroFormacion/show.php';
        

        // TAREA:
        // - Llama al método estático all() de tu modelo para traer todos los registros.
        // - Guarda eso en una variable.
        // - Haz un require_once de la vista 'show.php' correspondiente.
    }

    // 2. Mostrar formulario vacío para registrar
    public function register() {
        require_once 'views/CentroFormacion/register.php';
        // TAREA:
        // - Simplemente haz require_once de la vista 'register.php' correspondiente.
    }

    // 3. Procesar los datos y guardarlos
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $centro = new CentroFormacion($_POST['cent_id'], $_POST['cent_nombre']);
            CentroFormacion::save($centro);
            header('Location: ?controller=CentroFormacion&action=index');
        }
        // TAREA:
        // - Verifica si llegaron por $_POST el ID y los demás campos (como cent_nombre).
        // - Instancia un nuevo objeto CentroFormacion con esos datos.
        // - Invoca el método estático save() de tu modelo pasándole el objeto.
        // - Si todo sale bien, redirige usando header('Location: ?controller=CentroFormacion&action=index');
    }

    // 4. Mostrar detalles de un registro
    public function details() {
        $centro = CentroFormacion::searchById($_GET['id']);
        require_once 'views/CentroFormacion/details.php';
        // TAREA:
        // - Verifica si llegó un ID por la URL ($_GET['id']).
        // - Si llegó, usa searchById() del modelo y guárdalo en una variable.
        // - Haz require_once de 'details.php'.
    }

    // 5. Mostrar formulario para actualizar
    public function updateshow() {
        // TAREA:
        // - Igual que details(), verifica el $_GET['id'].
        // - Usa searchById() del modelo y guárdalo en una variable.
        // - Haz require_once de 'updateshow.php'. Esto servirá para que la vista rellene los <input>.
    }

    // 6. Procesar actualización en la BD
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $centro = new CentroFormacion($_POST['cent_id'], $_POST['cent_nombre']);
            CentroFormacion::update($centro);
            header('Location: ?controller=CentroFormacion&action=index');
        }
        // TAREA:
        // - Verifica si llegaron TODOS los campos del formulario por $_POST.
        // - Crea un objeto del modelo con esos datos recopilados e inyectados.
        // - Llama al método update() de tu modelo pasándole este objeto repleto de info fresca.
        // - Redirige a la tabla (action=index).
    }

    // 7. Eliminar registro
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            try {
                $centro = CentroFormacion::searchById($_GET['id']);
                CentroFormacion::delete($_GET['id']);
                header('Location: ?controller=CentroFormacion&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=CentroFormacion&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=CentroFormacion&action=index&error=general');
                }
            }
        }
    }
}
?>
