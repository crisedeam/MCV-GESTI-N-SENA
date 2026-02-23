<?php 
class Intructor {
    private $inst_id;
    private $inst_nombre;
    private $inst_apellido;
    private $inst_correo;
    private $inst_telefono;
    private $CENTRO_FORMACION_cent_id;
    public function __construct($inst_id, $inst_nombre, $inst_apellido, $inst_correo, $inst_telefono, $CENTRO_FORMACION_cent_id){
    $this->inst_id = $inst_id;
    $this->inst_nombre = $inst_nombre;
    $this->inst_apellido = $inst_apellido;
    $this->inst_correo = $inst_correo;
    $this->inst_telefono = $inst_telefono;
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;    
}
public function getInst_id(){
    return $this->inst_id;
}
public function setInst_id(){
    $this->inst_id = $inst_id;
}
public function getInst_nombre(){
    return $this->inst_nombre;
}
public function setInst_nombre(){
    $this->inst_nombre = $inst_nombre;
}
public function getInst_apellido(){
    return $this->inst_apellido;
}
public function setInst_apellido(){
    $this->inst_apellido = $inst_apellido;
}
public function getInst_correo(){
    return $this->inst_correo;
}
public function setInst_correo(){
    $this->inst_correo = $inst_correo;
}
public function getInst_telefono(){
    return $this->inst_telefono;
}
public function setInst_telefono(){
    $this->inst_telefono = $inst_telefono;
}
public function getCENTRO_FORMACION_cent_id(){
    return $this->CENTRO_FORMACION_cent_id;
}
public function setCENTRO_FORMACION_cent_id(){
    $this->CENTRO_FORMACION_cent_id = $CENTRO_FORMACION_cent_id;
}
public static function save($intructor){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO instructor VALUES (:inst_id, :inst_nombres, :inst_apellidos, :inst_correo, :inst_telefono, :CENTRO_FORMACION_cent_id)');
    $insert->bindValue('inst_id',$intructor->getInst_id());
    $insert->bindValue('inst_nombres',$intructor->getInst_nombre());
    $insert->bindValue('inst_apellidos',$intructor->getInst_apellido());
    $insert->bindValue('inst_correo',$intructor->getInst_correo());
    $insert->bindValue('inst_telefono',$intructor->getInst_telefono());
    $insert->bindValue('CENTRO_FORMACION_cent_id',$intructor->getCENTRO_FORMACION_cent_id());
    $insert->execute();
}   
public static function all(){
    $db=DB::getConnect();
    $listaIntructores=[];
    $select=$db->query('SELECT * FROM instructor ORDER BY inst_id');
    foreach($select->fetchAll() as $intructor){
        $listaIntructores[]=new Intructor($intructor['inst_id'],$intructor['inst_nombres'],$intructor['inst_apellidos'],$intructor['inst_correo'],$intructor['inst_telefono'],$intructor['CENTRO_FORMACION_cent_id']);
    }
    return $listaIntructores; 
}   
public static function searchById($inst_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM instructor WHERE inst_id=:inst_id');
    $select->bindValue('inst_id',$inst_id);
    $select->execute();

    $intructorDb=$select->fetch();


    $intructor = new Intructor ($intructorDb['inst_id'],$intructorDb['inst_nombres'],$intructorDb['inst_apellidos'],$intructorDb['inst_correo'],$intructorDb['inst_telefono'],$intructorDb['CENTRO_FORMACION_cent_id']);
    //var_dump($intructor);
    //die();
    return $intructor;
}
public static function update($intructor){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE instructor SET inst_nombres=:inst_nombres, inst_apellidos=:inst_apellidos, inst_correo=:inst_correo, inst_telefono=:inst_telefono, CENTRO_FORMACION_cent_id=:CENTRO_FORMACION_cent_id WHERE inst_id=:inst_id');
    $update->bindValue('inst_nombres', $intructor->getInst_nombre());
    $update->bindValue('inst_apellidos', $intructor->getInst_apellido());
    $update->bindValue('inst_correo', $intructor->getInst_correo());
    $update->bindValue('inst_telefono', $intructor->getInst_telefono());
    $update->bindValue('CENTRO_FORMACION_cent_id', $intructor->getCENTRO_FORMACION_cent_id());
    $update->bindValue('inst_id',$intructor->getInst_id());
    $update->execute();
}
public static function delete($inst_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM instructor WHERE inst_id=:inst_id');
    $delete->bindValue('inst_id',$inst_id);
    $delete->execute();	
}



}
