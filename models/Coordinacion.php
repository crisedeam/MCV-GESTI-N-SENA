<?php 
class Coordinacion {
    private $coord_id;
    private $coord_descripcion;
    private $CENTRO_FORMACION_cent_id;
    private $coord_nombre_coordinador;
    private $coord_correo;
    private $coord_password;

    public function __construct($coord_id, $coord_descripcion, $CENTRO_FORMACION_cent_id, $coord_nombre_coordinador, $coord_correo, $coord_password){
        $this->coord_id = $coord_id;
        $this->coord_descripcion = $coord_descripcion;
        $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;    
        $this->coord_nombre_coordinador = $coord_nombre_coordinador;
        $this->coord_correo = $coord_correo;
        $this->coord_password = $coord_password;
    }
public function getCoord_id(){
    return $this->coord_id;
}
public function setCoord_id($coord_id){
    $this->coord_id = $coord_id;
}
public function getCoord_descripcion(){
    return $this->coord_descripcion;
}
public function setCoord_descripcion($coord_descripcion){
    $this->coord_descripcion = $coord_descripcion;
}
public function getCENTRO_FORMACION_cent_id(){
    return $this->CENTRO_FORMACION_cent_id;
}
public function setCENTRO_FORMACION_cent_id($CENTRO_FORMACION_cent_id){
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;
}
public function getCoord_nombre_coordinador(){
    return $this->coord_nombre_coordinador;
}
public function setCoord_nombre_coordinador($coord_nombre_coordinador){
    $this->coord_nombre_coordinador = $coord_nombre_coordinador;
}
public function getCoord_correo(){
    return $this->coord_correo;
}
public function setCoord_correo($coord_correo){
    $this->coord_correo = $coord_correo;
}
public function getCoord_password(){
    return $this->coord_password;
}
public function setCoord_password($coord_password){
    $this->coord_password = $coord_password;
}
public static function save($coordinacion){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO coordinacion VALUES (:coord_id, :coord_descripcion, :CENTRO_FORMACION_cent_id, :coord_nombre_coordinador, :coord_correo, :coord_password)');
    $insert->bindValue('coord_id',$coordinacion->getCoord_id());
    $insert->bindValue('coord_descripcion',$coordinacion->getCoord_descripcion());
    $insert->bindValue('CENTRO_FORMACION_cent_id',$coordinacion->getCENTRO_FORMACION_cent_id());
    $insert->bindValue('coord_nombre_coordinador',$coordinacion->getCoord_nombre_coordinador());
    $insert->bindValue('coord_correo',$coordinacion->getCoord_correo());
    // Hash password before saving
    $hashedPassword = password_hash($coordinacion->getCoord_password(), PASSWORD_DEFAULT);
    $insert->bindValue('coord_password', $hashedPassword);
    $insert->execute();
}   
public static function all(){
    $db=DB::getConnect();
    $listaCoordinacions=[];
    $select=$db->query('SELECT * FROM coordinacion ORDER BY coord_id');
    foreach($select->fetchAll() as $coordinacion){
        $listaCoordinacions[]=new Coordinacion($coordinacion['coord_id'],$coordinacion['coord_descripcion'],$coordinacion['CENTRO_FORMACION_cent_id'],$coordinacion['coord_nombre_coordinador'],$coordinacion['coord_correo'],$coordinacion['coord_password']);
    }
    return $listaCoordinacions; 
}   
public static function searchById($coord_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM coordinacion WHERE coord_id=:coord_id');
    $select->bindValue('coord_id',$coord_id);
    $select->execute();

    $coordinacionDb=$select->fetch();

    if ($coordinacionDb) {
        $coordinacion = new Coordinacion ($coordinacionDb['coord_id'],$coordinacionDb['coord_descripcion'],$coordinacionDb['CENTRO_FORMACION_cent_id'],$coordinacionDb['coord_nombre_coordinador'],$coordinacionDb['coord_correo'],$coordinacionDb['coord_password']);
        return $coordinacion;
    }
    return null;
}
public static function update($coordinacion){
    $db=DB::getConnect();
    
    // Si la contraseña viene vacía en el objeto, no la actualizamos para que no se sobreescriba con un string vacío
    if (!empty($coordinacion->getCoord_password())) {
        $update=$db->prepare('UPDATE coordinacion SET coord_descripcion=:coord_descripcion, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id, coord_nombre_coordinador=:coord_nombre_coordinador, coord_correo=:coord_correo, coord_password=:coord_password WHERE coord_id=:coord_id');
        $hashedPassword = password_hash($coordinacion->getCoord_password(), PASSWORD_DEFAULT);
        $update->bindValue('coord_password', $hashedPassword);
    } else {
        $update=$db->prepare('UPDATE coordinacion SET coord_descripcion=:coord_descripcion, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id, coord_nombre_coordinador=:coord_nombre_coordinador, coord_correo=:coord_correo WHERE coord_id=:coord_id');
    }

    $update->bindValue('coord_descripcion', $coordinacion->getCoord_descripcion());
    $update->bindValue('CENTRO_FORMACION_cent_id', $coordinacion->getCENTRO_FORMACION_cent_id());
    $update->bindValue('coord_nombre_coordinador', $coordinacion->getCoord_nombre_coordinador());
    $update->bindValue('coord_correo', $coordinacion->getCoord_correo());
    $update->bindValue('coord_id',$coordinacion->getCoord_id());
    $update->execute();
}
public static function delete($coord_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM coordinacion WHERE coord_id=:coord_id');
    $delete->bindValue('coord_id',$coord_id);
    $delete->execute();	
}

}
