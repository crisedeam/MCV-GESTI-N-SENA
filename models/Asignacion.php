<?php 
class Asignacion {
    private $ASIG_ID;
    private $INSTRUCTOR_inst_id;
    private $asig_fecha_ini;
    private $asig_fecha_fin;
    private $FICHA_fich_id;
    private $AMBIENTE_amb_id;
    private $COMPETENCIA_comp_id;

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

    public static function save($asignacion){
        $db=DB::getConnect();
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
        $select=$db->query('SELECT * FROM asignacion ORDER BY ASIG_ID');
        foreach($select->fetchAll() as $asignacion){
            $listaAsignaciones[]=new Asignacion($asignacion['ASIG_ID'],$asignacion['INSTRUCTOR_inst_id'],$asignacion['asig_fecha_ini'],$asignacion['asig_fecha_fin'],$asignacion['FICHA_fich_id'],$asignacion['AMBIENTE_amb_id'],$asignacion['COMPETENCIA_comp_id']);
        }
        return $listaAsignaciones; 
    }

    public static function searchById($ASIG_ID){
        $db=DB::getConnect();
        $select=$db->prepare('SELECT * FROM asignacion WHERE ASIG_ID=:ASIG_ID');
        $select->bindValue('ASIG_ID',$ASIG_ID);
        $select->execute();

        $asignacionDb=$select->fetch();

        if ($asignacionDb) {
            return new Asignacion($asignacionDb['ASIG_ID'],$asignacionDb['INSTRUCTOR_inst_id'],$asignacionDb['asig_fecha_ini'],$asignacionDb['asig_fecha_fin'],$asignacionDb['FICHA_fich_id'],$asignacionDb['AMBIENTE_amb_id'],$asignacionDb['COMPETENCIA_comp_id']);
        }
        return null;
    }

    public static function update($asignacion){
        $db=DB::getConnect();
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
        $delete=$db->prepare('DELETE FROM asignacion WHERE ASIG_ID=:ASIG_ID');
        $delete->bindValue('ASIG_ID',$ASIG_ID);
        $delete->execute();	
    }
}
?>
