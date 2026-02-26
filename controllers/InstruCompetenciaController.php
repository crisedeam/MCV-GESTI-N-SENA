<?php
require_once 'models/InstruCompetencia.php';
require_once 'models/Instructor.php';
require_once 'models/Programa.php';
require_once 'models/Competencia.php';

class InstruCompetenciaController {
    public function index() { 
        static $listaInstruComp = [];
        $listaInstruComp = InstruCompetencia::all();
        $totalAvales = count($listaInstruComp);
        
        // Cargar nombres asociados (simplificado para la vista)
        $instructoresMap = [];
        foreach(Instructor::all() as $inst) {
            $instructoresMap[$inst->getInst_id()] = $inst->getInst_nombre() . ' ' . $inst->getInst_apellido();
        }
        $competenciasMap = [];
        foreach(Competencia::all() as $comp) {
            $competenciasMap[$comp->getComp_id()] = $comp->getComp_nombre_corto();
        }

        require_once 'views/InstruCompetencia/show.php';
    }
    public function register() { 
        $listaInstructores = Instructor::all();
        $listaProgramas = Programa::all();
        $listaCompetencias = Competencia::all();
        require_once 'views/InstruCompetencia/register.php';
    }
    public function save() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $instrucomp = new InstruCompetencia(null, $_POST['INSTRUCTOR_inst_id'], $_POST['COMPETxPROGRAMA_PROGRAMA_prog_id'], $_POST['COMPETxPROGRAMA_COMPETENCIA_comp_id'], $_POST['inscomp_vigencia']);
                InstruCompetencia::save($instrucomp);
                header('Location: ?controller=InstruCompetencia&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=InstruCompetencia&action=register&error=foreign_key_comp_prog');
                } else {
                    header('Location: ?controller=InstruCompetencia&action=register&error=general');
                }
            }
        }
    }
    public function details() { 
        $instrucomp = InstruCompetencia::searchById($_GET['id']);
        require_once 'views/InstruCompetencia/details.php';
    }
    public function updateshow() { 
        $instrucomp = InstruCompetencia::searchById($_GET['id']);
        $listaInstructores = Instructor::all();
        $listaProgramas = Programa::all();
        $listaCompetencias = Competencia::all();
        require_once 'views/InstruCompetencia/updateshow.php';
    }
    public function update() { 
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            try {
                $instrucomp = new InstruCompetencia($_POST['inscomp_id'], $_POST['INSTRUCTOR_inst_id'], $_POST['COMPETxPROGRAMA_PROGRAMA_prog_id'], $_POST['COMPETxPROGRAMA_COMPETENCIA_comp_id'], $_POST['inscomp_vigencia']);
                InstruCompetencia::update($instrucomp);
                header('Location: ?controller=InstruCompetencia&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=InstruCompetencia&action=updateshow&id=' . $_POST['inscomp_id'] . '&error=foreign_key_comp_prog');
                } else {
                    header('Location: ?controller=InstruCompetencia&action=updateshow&id=' . $_POST['inscomp_id'] . '&error=general');
                }
            }
        }
    }
    public function delete() { 
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            try {
                InstruCompetencia::delete($_GET['id']);
                header('Location: ?controller=InstruCompetencia&action=index');
            } catch (PDOException $e) {
                if ($e->getCode() == '23000') {
                    header('Location: ?controller=InstruCompetencia&action=index&error=foreign_key');
                } else {
                    header('Location: ?controller=InstruCompetencia&action=index&error=general');
                }
            }
        }
    }
}
?>
