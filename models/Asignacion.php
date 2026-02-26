<?php 
class Asignacion {
    private $ASIG_ID;
    private $INSTRUCTOR_inst_id;
    private $asig_fecha_ini;
    private $asig_fecha_fin;
    private $FICHA_fich_id;
    private $AMBIENTE_amb_id;
    private $COMPETENCIA_comp_id;
    
    // Nombres adicionales para la vista
    private $instructor_nombre;
    private $competencia_nombre;
    private $programa_id;

    public function __construct($ASIG_ID, $INSTRUCTOR_inst_id, $asig_fecha_ini, $asig_fecha_fin, $FICHA_fich_id, $AMBIENTE_amb_id, $COMPETENCIA_comp_id){
        $this->ASIG_ID = $ASIG_ID;
        $this->INSTRUCTOR_inst_id = $INSTRUCTOR_inst_id;
        $this->asig_fecha_ini = $asig_fecha_ini;
        $this->asig_fecha_fin = $asig_fecha_fin;
        $this->FICHA_fich_id = $FICHA_fich_id;
        $this->AMBIENTE_amb_id = $AMBIENTE_amb_id;
        $this->COMPETENCIA_comp_id = $COMPETENCIA_comp_id;
    }

    public function getASIG_ID(){ return $this->ASIG_ID; }
    public function setASIG_ID($ASIG_ID){ $this->ASIG_ID = $ASIG_ID; }
    
    public function getINSTRUCTOR_inst_id(){ return $this->INSTRUCTOR_inst_id; }
    public function setINSTRUCTOR_inst_id($INSTRUCTOR_inst_id){ $this->INSTRUCTOR_inst_id = $INSTRUCTOR_inst_id; }
    
    public function getAsig_fecha_ini(){ return $this->asig_fecha_ini; }
    public function setAsig_fecha_ini($asig_fecha_ini){ $this->asig_fecha_ini = $asig_fecha_ini; }
    
    public function getAsig_fecha_fin(){ return $this->asig_fecha_fin; }
    public function setAsig_fecha_fin($asig_fecha_fin){ $this->asig_fecha_fin = $asig_fecha_fin; }
    
    public function getFICHA_fich_id(){ return $this->FICHA_fich_id; }
    public function setFICHA_fich_id($FICHA_fich_id){ $this->FICHA_fich_id = $FICHA_fich_id; }
    
    public function getAMBIENTE_amb_id(){ return $this->AMBIENTE_amb_id; }
    public function setAMBIENTE_amb_id($AMBIENTE_amb_id){ $this->AMBIENTE_amb_id = $AMBIENTE_amb_id; }
    
    public function getCOMPETENCIA_comp_id(){ return $this->COMPETENCIA_comp_id; }
    public function setCOMPETENCIA_comp_id($COMPETENCIA_comp_id){ $this->COMPETENCIA_comp_id = $COMPETENCIA_comp_id; }

    public function getInstructor_nombre(){ return $this->instructor_nombre; }
    public function setInstructor_nombre($instructor_nombre){ $this->instructor_nombre = $instructor_nombre; }

    public function getCompetencia_nombre(){ return $this->competencia_nombre; }
    public function setCompetencia_nombre($competencia_nombre){ $this->competencia_nombre = $competencia_nombre; }

    public function getPrograma_id(){ return $this->programa_id; }
    public function setPrograma_id($programa_id){ $this->programa_id = $programa_id; }

    public static function save($asignacion){
        $db=DB::getConnect();
        
        $usuario_ejecutor = isset($_SESSION['rol']) ? $_SESSION['rol'] . ' - ' . $_SESSION['nombre'] . ' (ID: ' . $_SESSION['usuario_id'] . ')' : 'Sistema/Desconocido';
        $db->exec("SET @usuario_actual = '$usuario_ejecutor'");
        
        $insert=$db->prepare('INSERT INTO asignacion (INSTRUCTOR_inst_id, asig_fecha_ini, asig_fecha_fin, FICHA_fich_id, AMBIENTE_amb_id, COMPETENCIA_comp_id) VALUES (:INSTRUCTOR_inst_id, :asig_fecha_ini, :asig_fecha_fin, :FICHA_fich_id, :AMBIENTE_amb_id, :COMPETENCIA_comp_id)');
        $insert->bindValue('INSTRUCTOR_inst_id',$asignacion->getINSTRUCTOR_inst_id());
        $insert->bindValue('asig_fecha_ini',$asignacion->getAsig_fecha_ini());
        $insert->bindValue('asig_fecha_fin',$asignacion->getAsig_fecha_fin());
        $insert->bindValue('FICHA_fich_id',$asignacion->getFICHA_fich_id());
        $insert->bindValue('AMBIENTE_amb_id',$asignacion->getAMBIENTE_amb_id());
        $insert->bindValue('COMPETENCIA_comp_id',$asignacion->getCOMPETENCIA_comp_id());
        $insert->execute();
        return $db->lastInsertId();
    }

    public static function all(){
        $db=DB::getConnect();
        $listaAsignaciones=[];
        
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select=$db->prepare('
                SELECT a.*, 
                       CONCAT(i.inst_nombres, " ", i.inst_apellidos) AS instructor_nombre,
                       c.comp_nombre_corto AS competencia_nombre,
                       f.PROGRAMA_prog_id AS programa_id
                FROM asignacion a
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                JOIN ficha f ON a.FICHA_fich_id = f.fich_id
                WHERE i.CENTRO_FORMACION_cent_id = :centro_id
                ORDER BY a.asig_fecha_ini DESC, a.ASIG_ID DESC
            ');
            $select->bindValue(':centro_id', $centro_id);
            $select->execute();
            $results = $select->fetchAll();
        } else {
            $select=$db->query('
                SELECT a.*, 
                       CONCAT(i.inst_nombres, " ", i.inst_apellidos) AS instructor_nombre,
                       c.comp_nombre_corto AS competencia_nombre,
                       f.PROGRAMA_prog_id AS programa_id
                FROM asignacion a
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                JOIN ficha f ON a.FICHA_fich_id = f.fich_id
                ORDER BY a.asig_fecha_ini DESC, a.ASIG_ID DESC
            ');
            $results = $select->fetchAll();
        }
        
        foreach($results as $item){
            $asignacion = new Asignacion($item['ASIG_ID'],$item['INSTRUCTOR_inst_id'],$item['asig_fecha_ini'],$item['asig_fecha_fin'],$item['FICHA_fich_id'],$item['AMBIENTE_amb_id'],$item['COMPETENCIA_comp_id']);
            $asignacion->setInstructor_nombre($item['instructor_nombre'] ?? '');
            $asignacion->setCompetencia_nombre($item['competencia_nombre'] ?? '');
            $asignacion->setPrograma_id($item['programa_id'] ?? '');
            $listaAsignaciones[] = $asignacion;
        }
        return $listaAsignaciones; 
    }

    public static function checkDuplicate($instructor_id, $ficha_id, $ambiente_id, $competencia_id, $exclude_asig_id = null){
        $db=DB::getConnect();
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        $sql = 'SELECT COUNT(*) as count FROM asignacion a';
        if ($centro_id !== null && $centro_id !== '') {
            $sql .= ' JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id ';
        }
        
        $sql .= ' WHERE a.INSTRUCTOR_inst_id=:instructor AND a.FICHA_fich_id=:ficha AND a.AMBIENTE_amb_id=:ambiente AND a.COMPETENCIA_comp_id=:competencia';
        
        if ($centro_id !== null && $centro_id !== '') {
            $sql .= ' AND i.CENTRO_FORMACION_cent_id = :centro_id';
        }
        if ($exclude_asig_id !== null) {
            $sql .= ' AND a.ASIG_ID != :exclude_id';
        }
        
        $select=$db->prepare($sql);
        $select->bindValue('instructor', $instructor_id);
        $select->bindValue('ficha', $ficha_id);
        $select->bindValue('ambiente', $ambiente_id);
        $select->bindValue('competencia', $competencia_id);
        
        if ($centro_id !== null && $centro_id !== '') {
            $select->bindValue('centro_id', $centro_id);
        }
        if ($exclude_asig_id !== null) {
            $select->bindValue('exclude_id', $exclude_asig_id);
        }
        
        $select->execute();
        $result = $select->fetch();
        return $result['count'] > 0;
    }
    
    public static function searchById($ASIG_ID){
        $db=DB::getConnect();
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select=$db->prepare('
                SELECT a.*, 
                       CONCAT(i.inst_nombres, " ", i.inst_apellidos) AS instructor_nombre,
                       c.comp_nombre_corto AS competencia_nombre,
                       f.PROGRAMA_prog_id AS programa_id
                FROM asignacion a
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                JOIN ficha f ON a.FICHA_fich_id = f.fich_id
                WHERE a.ASIG_ID=:ASIG_ID AND i.CENTRO_FORMACION_cent_id = :centro_id
            ');
            $select->bindValue('centro_id', $centro_id);
        } else {
            $select=$db->prepare('
                SELECT a.*, 
                       CONCAT(i.inst_nombres, " ", i.inst_apellidos) AS instructor_nombre,
                       c.comp_nombre_corto AS competencia_nombre,
                       f.PROGRAMA_prog_id AS programa_id
                FROM asignacion a
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                JOIN competencia c ON a.COMPETENCIA_comp_id = c.comp_id
                JOIN ficha f ON a.FICHA_fich_id = f.fich_id
                WHERE a.ASIG_ID=:ASIG_ID
            ');
        }
        
        $select->bindValue('ASIG_ID',$ASIG_ID);
        $select->execute();

        $asignacionDb=$select->fetch();

        if ($asignacionDb) {
            $asignacion = new Asignacion($asignacionDb['ASIG_ID'],$asignacionDb['INSTRUCTOR_inst_id'],$asignacionDb['asig_fecha_ini'],$asignacionDb['asig_fecha_fin'],$asignacionDb['FICHA_fich_id'],$asignacionDb['AMBIENTE_amb_id'],$asignacionDb['COMPETENCIA_comp_id']);
            $asignacion->setInstructor_nombre($asignacionDb['instructor_nombre'] ?? '');
            $asignacion->setCompetencia_nombre($asignacionDb['competencia_nombre'] ?? '');
            $asignacion->setPrograma_id($asignacionDb['programa_id'] ?? '');
            return $asignacion;
        }
        return null;
    }

    public static function update($asignacion){
        $db=DB::getConnect();
        
        $usuario_ejecutor = isset($_SESSION['rol']) ? $_SESSION['rol'] . ' - ' . $_SESSION['nombre'] . ' (ID: ' . $_SESSION['usuario_id'] . ')' : 'Sistema/Desconocido';
        $db->exec("SET @usuario_actual = '$usuario_ejecutor'");
        
        $update=$db->prepare('UPDATE asignacion SET INSTRUCTOR_inst_id=:INSTRUCTOR_inst_id, asig_fecha_ini=:asig_fecha_ini, asig_fecha_fin=:asig_fecha_fin, FICHA_fich_id=:FICHA_fich_id, AMBIENTE_amb_id=:AMBIENTE_amb_id, COMPETENCIA_comp_id=:COMPETENCIA_comp_id WHERE ASIG_ID=:ASIG_ID');
        $update->bindValue('INSTRUCTOR_inst_id', $asignacion->getINSTRUCTOR_inst_id());
        $update->bindValue('asig_fecha_ini', $asignacion->getAsig_fecha_ini());
        $update->bindValue('asig_fecha_fin', $asignacion->getAsig_fecha_fin());
        $update->bindValue('FICHA_fich_id', $asignacion->getFICHA_fich_id());
        $update->bindValue('AMBIENTE_amb_id', $asignacion->getAMBIENTE_amb_id());
        $update->bindValue('COMPETENCIA_comp_id', $asignacion->getCOMPETENCIA_comp_id());
        $update->bindValue('ASIG_ID',$asignacion->getASIG_ID());
        $update->execute();
    }

    public static function delete($ASIG_ID){
        $db=DB::getConnect();
        
        $usuario_ejecutor = isset($_SESSION['rol']) ? $_SESSION['rol'] . ' - ' . $_SESSION['nombre'] . ' (ID: ' . $_SESSION['usuario_id'] . ')' : 'Sistema/Desconocido';
        $db->exec("SET @usuario_actual = '$usuario_ejecutor'");
        
        $delete=$db->prepare('DELETE FROM asignacion WHERE ASIG_ID=:ASIG_ID');
        $delete->bindValue('ASIG_ID',$ASIG_ID);
        $delete->execute();	
    }
}
?>
