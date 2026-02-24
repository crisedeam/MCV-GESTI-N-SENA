<?php
require_once 'models/Asignacion.php';
require_once 'models/Instructor.php';
require_once 'models/Ficha.php';
require_once 'models/Ambiente.php';
require_once 'models/Competencia.php';
require_once 'models/DetalleAsignacion.php';

class AsignacionController {
    public function index() { 
        if (isset($_SESSION['rol']) && $_SESSION['rol'] === 'instructor') {
            $instructor_id = $_SESSION['usuario_id'];
            $db = DB::getConnect();
            $select = $db->prepare("
                SELECT a.ASIG_ID, a.FICHA_fich_id, am.amb_nombre, c.comp_nombre_corto, 
                       d.detasig_hora_ini, d.detasig_hora_fin
                FROM asignacion a
                JOIN detallexasignacion d ON a.ASIG_ID = d.ASIGNACION_ASIG_ID
                JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                JOIN ambiente am ON a.AMBIENTE_amb_id = am.amb_id
                WHERE a.INSTRUCTOR_inst_id = :inst_id
            ");
            $select->bindValue('inst_id', $instructor_id);
            $select->execute();
            
            $eventos = [];
            foreach($select->fetchAll() as $row) {
                $eventos[] = [
                    'title' => "Ficha: " . $row['FICHA_fich_id'] . "\nAmb: " . $row['amb_nombre'] . "\nComp: " . $row['comp_nombre_corto'],
                    'start' => $row['detasig_hora_ini'],
                    'end' => $row['detasig_hora_fin'],
                    'color' => '#39A900' // Verde SENA
                ];
            }
            $eventosJson = json_encode($eventos);
            require_once 'views/Asignacion/calendar.php';
        } else {
            static $listaAsignaciones = [];
            $listaAsignaciones = Asignacion::all();
            $totalAsignaciones = count($listaAsignaciones);
            require_once 'views/Asignacion/show.php';
        }
    }
    public function register() { 
        $listaInstructores = Instructor::all();
        $listaFichas = Ficha::all();
        $listaAmbientes = Ambiente::all();
        $listaCompetencias = Competencia::all();
        require_once 'views/Asignacion/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $fecha_ini = $_POST['fecha_inicio'] . ' ' . $_POST['hora_inicio'] . ':00';
                $fecha_fin = $_POST['fecha_fin'] . ' ' . $_POST['hora_fin'] . ':00';
                
                $asignacion = new Asignacion(null, $_POST['INSTRUCTOR_inst_id'], $fecha_ini, $fecha_fin, $_POST['FICHA_fich_id'], $_POST['AMBIENTE_amb_id'], $_POST['COMPETENCIA_comp_id']);
                $asig_id = Asignacion::save($asignacion);
                
                if (isset($_POST['dias']) && is_array($_POST['dias']) && $asig_id) {
                    $diasSeleccionados = $_POST['dias'];
                    $currentDate = new DateTime($_POST['fecha_inicio']);
                    $endDate = new DateTime($_POST['fecha_fin']);
                    
                    while ($currentDate <= $endDate) {
                        $dayOfWeek = $currentDate->format('w'); // 0=Dom, 1=Lun...
                        if (in_array($dayOfWeek, $diasSeleccionados)) {
                            $dt_ini = $currentDate->format('Y-m-d') . ' ' . $_POST['hora_inicio'] . ':00';
                            $dt_fin = $currentDate->format('Y-m-d') . ' ' . $_POST['hora_fin'] . ':00';
                            
                            $detalle = new DetalleAsignacion(null, $asig_id, $dt_ini, $dt_fin);
                            DetalleAsignacion::save($detalle);
                        }
                        $currentDate->modify('+1 day');
                    }
                }
                header('Location: ?controller=Asignacion&action=index');
            } catch (\Throwable $e) {
                die("Error en Save Asignacion: " . $e->getMessage() . " en " . $e->getFile() . " L" . $e->getLine());
            }
        }
    }
    public function details() { 
        $asignacion = Asignacion::searchById($_GET['id']);
        require_once 'views/Asignacion/details.php';
    }
    public function updateshow() { 
        $asignacion = Asignacion::searchById($_GET['id']);
        $listaInstructores = Instructor::all();
        $listaFichas = Ficha::all();
        $listaAmbientes = Ambiente::all();
        $listaCompetencias = Competencia::all();
        require_once 'views/Asignacion/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $fecha_ini = $_POST['fecha_inicio'] . ' ' . $_POST['hora_inicio'] . ':00';
                $fecha_fin = $_POST['fecha_fin'] . ' ' . $_POST['hora_fin'] . ':00';

                $asignacion = new Asignacion($_POST['ASIG_ID'], $_POST['INSTRUCTOR_inst_id'], $fecha_ini, $fecha_fin, $_POST['FICHA_fich_id'], $_POST['AMBIENTE_amb_id'], $_POST['COMPETENCIA_comp_id']);
                Asignacion::update($asignacion);
                
                $db=DB::getConnect();
                $delete=$db->prepare('DELETE FROM detallexasignacion WHERE ASIGNACION_ASIG_ID=:ASID');
                $delete->bindValue('ASID', $_POST['ASIG_ID']);
                $delete->execute();

                if (isset($_POST['dias']) && is_array($_POST['dias'])) {
                    $diasSeleccionados = $_POST['dias'];
                    $currentDate = new DateTime($_POST['fecha_inicio']);
                    $endDate = new DateTime($_POST['fecha_fin']);
                    
                    while ($currentDate <= $endDate) {
                        $dayOfWeek = $currentDate->format('w');
                        if (in_array($dayOfWeek, $diasSeleccionados)) {
                            $dt_ini = $currentDate->format('Y-m-d') . ' ' . $_POST['hora_inicio'] . ':00';
                            $dt_fin = $currentDate->format('Y-m-d') . ' ' . $_POST['hora_fin'] . ':00';
                            
                            $detalle = new DetalleAsignacion(null, $_POST['ASIG_ID'], $dt_ini, $dt_fin);
                            DetalleAsignacion::save($detalle);
                        }
                        $currentDate->modify('+1 day');
                    }
                }
                header('Location: ?controller=Asignacion&action=index');
            } catch (\Throwable $e) {
                die("Error en Update Asignacion: " . $e->getMessage() . " en " . $e->getFile() . " L" . $e->getLine());
            }
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                Asignacion::delete($_GET['id']);
                header('Location: ?controller=Asignacion&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=Asignacion&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=Asignacion&action=index&error=general');
                }
            }
        }
    }
}
?>
