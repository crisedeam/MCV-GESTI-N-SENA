<?php 
class DetalleAsignacion {
    private $detasig_id;
    private $ASIGNACION_ASIG_ID;
    private $detasig_hora_ini;
    private $detasig_hora_fin;

    public function __construct($detasig_id, $ASIGNACION_ASIG_ID, $detasig_hora_ini, $detasig_hora_fin){
        $this->detasig_id = $detasig_id;
        $this->ASIGNACION_ASIG_ID = $ASIGNACION_ASIG_ID;
        $this->detasig_hora_ini = $detasig_hora_ini;
        $this->detasig_hora_fin = $detasig_hora_fin;
    }

    public function getDetasig_id(){ return $this->detasig_id; }
    public function setDetasig_id($detasig_id){ $this->detasig_id = $detasig_id; }
    
    public function getASIGNACION_ASIG_ID(){ return $this->ASIGNACION_ASIG_ID; }
    public function setASIGNACION_ASIG_ID($ASIGNACION_ASIG_ID){ $this->ASIGNACION_ASIG_ID = $ASIGNACION_ASIG_ID; }
    
    public function getDetasig_hora_ini(){ return $this->detasig_hora_ini; }
    public function setDetasig_hora_ini($detasig_hora_ini){ $this->detasig_hora_ini = $detasig_hora_ini; }
    
    public function getDetasig_hora_fin(){ return $this->detasig_hora_fin; }
    public function setDetasig_hora_fin($detasig_hora_fin){ $this->detasig_hora_fin = $detasig_hora_fin; }

    public static function save($detalle){
        $db=DB::getConnect();
        $insert=$db->prepare('INSERT INTO detallexasignacion (ASIGNACION_ASIG_ID, detasig_hora_ini, detasig_hora_fin) VALUES (:ASIGNACION_ASIG_ID, :detasig_hora_ini, :detasig_hora_fin)');
        $insert->bindValue('ASIGNACION_ASIG_ID',$detalle->getASIGNACION_ASIG_ID());
        $insert->bindValue('detasig_hora_ini',$detalle->getDetasig_hora_ini());
        $insert->bindValue('detasig_hora_fin',$detalle->getDetasig_hora_fin());
        $insert->execute();
    }

    public static function all(){
        $db=DB::getConnect();
        $listaDetalles=[];
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select=$db->prepare('
                SELECT d.* 
                FROM detallexasignacion d
                JOIN asignacion a ON d.ASIGNACION_ASIG_ID = a.ASIG_ID
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                WHERE i.CENTRO_FORMACION_cent_id = :centro_id
                ORDER BY d.detasig_id
            ');
            $select->bindValue(':centro_id', $centro_id);
            $select->execute();
            $results = $select->fetchAll();
        } else {
            $select=$db->query('SELECT * FROM detallexasignacion ORDER BY detasig_id');
            $results = $select->fetchAll();
        }
        
        foreach($results as $detalle){
            $listaDetalles[]=new DetalleAsignacion($detalle['detasig_id'],$detalle['ASIGNACION_ASIG_ID'],$detalle['detasig_hora_ini'],$detalle['detasig_hora_fin']);
        }
        return $listaDetalles; 
    }

    public static function searchById($detasig_id){
        $db=DB::getConnect();
        $centro_id = $_SESSION['centro_id'] ?? null;
        
        if ($centro_id !== null && $centro_id !== '') {
            $select=$db->prepare('
                SELECT d.* 
                FROM detallexasignacion d
                JOIN asignacion a ON d.ASIGNACION_ASIG_ID = a.ASIG_ID
                JOIN instructor i ON a.INSTRUCTOR_inst_id = i.inst_id
                WHERE d.detasig_id=:detasig_id AND i.CENTRO_FORMACION_cent_id = :centro_id
            ');
            $select->bindValue('centro_id', $centro_id);
        } else {
            $select=$db->prepare('SELECT * FROM detallexasignacion WHERE detasig_id=:detasig_id');
        }
        
        $select->bindValue('detasig_id',$detasig_id);
        $select->execute();

        $detalleDb=$select->fetch();

        if ($detalleDb) {
            return new DetalleAsignacion($detalleDb['detasig_id'],$detalleDb['ASIGNACION_ASIG_ID'],$detalleDb['detasig_hora_ini'],$detalleDb['detasig_hora_fin']);
        }
        return null;
    }

    public static function update($detalle){
        $db=DB::getConnect();
        $update=$db->prepare('UPDATE detallexasignacion SET ASIGNACION_ASIG_ID=:ASIGNACION_ASIG_ID, detasig_hora_ini=:detasig_hora_ini, detasig_hora_fin=:detasig_hora_fin WHERE detasig_id=:detasig_id');
        $update->bindValue('ASIGNACION_ASIG_ID', $detalle->getASIGNACION_ASIG_ID());
        $update->bindValue('detasig_hora_ini', $detalle->getDetasig_hora_ini());
        $update->bindValue('detasig_hora_fin', $detalle->getDetasig_hora_fin());
        $update->bindValue('detasig_id',$detalle->getDetasig_id());
        $update->execute();
    }

    public static function delete($detasig_id){
        $db=DB::getConnect();
        $delete=$db->prepare('DELETE FROM detallexasignacion WHERE detasig_id=:detasig_id');
        $delete->bindValue('detasig_id',$detasig_id);
        $delete->execute();	
    }

    public static function deleteByAsignacionId($ASIG_ID){
        $db=DB::getConnect();
        $delete=$db->prepare('DELETE FROM detallexasignacion WHERE ASIGNACION_ASIG_ID=:ASIG_ID');
        $delete->bindValue('ASIG_ID',$ASIG_ID);
        $delete->execute();	
    }
}
?>
