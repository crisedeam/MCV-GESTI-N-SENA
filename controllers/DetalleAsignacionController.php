<?php
require_once 'models/DetalleAsignacion.php';

class DetalleAsignacionController {
    public function index() { 
        static $listaDetalles = [];
        $listaDetalles = DetalleAsignacion::all();
        // require_once 'views/DetalleAsignacion/show.php';
    }
    public function register() { 
        // require_once 'views/DetalleAsignacion/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $detalle = new DetalleAsignacion(null, $_POST['ASIGNACION_ASIG_ID'], $_POST['detasig_hora_ini'], $_POST['detasig_hora_fin']);
            DetalleAsignacion::save($detalle);
            header('Location: ?controller=DetalleAsignacion&action=index');
        }
    }
    public function details() { 
        $detalle = DetalleAsignacion::searchById($_GET['id']);
        // require_once 'views/DetalleAsignacion/details.php';
    }
    public function updateshow() { 
        $detalle = DetalleAsignacion::searchById($_GET['id']);
        // require_once 'views/DetalleAsignacion/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $detalle = new DetalleAsignacion($_POST['detasig_id'], $_POST['ASIGNACION_ASIG_ID'], $_POST['detasig_hora_ini'], $_POST['detasig_hora_fin']);
            DetalleAsignacion::update($detalle);
            header('Location: ?controller=DetalleAsignacion&action=index');
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                DetalleAsignacion::delete($_GET['id']);
                header('Location: ?controller=DetalleAsignacion&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=DetalleAsignacion&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=DetalleAsignacion&action=index&error=general');
                }
            }
        }
    }
}
?>
