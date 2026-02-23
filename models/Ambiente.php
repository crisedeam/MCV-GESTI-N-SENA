<?php 
class Ambiente {
    private $amb_id;
    private $amb_nombre;
    private $SEDE_sede_id;   
    public function __construct($amb_id, $amb_nombre, $SEDE_sede_id){
    $this->amb_id = $amb_id;
    $this->amb_nombre = $amb_nombre;
    $this->SEDE_sede_id = $SEDE_sede_id;
}
public function getAmb_id(){
   return $this->amb_id;
}
public function setAmb_id(){
    $this->amb_id = $amb_id;
}
public function getAmb_nombre(){
    return $this->amb_nombre;
}
public function setAmb_nombre($amb_nombre){
    $this->amb_nombre = $amb_nombre;
}
public function getSEDE_sede_id(){
    return $this->SEDE_sede_id; // fixed comma and logic
}
public function setSEDE_sede_id($SEDE_sede_id){ // added parameter
    $this->SEDE_sede_id = $SEDE_sede_id;
}
public static function save($ambiente){
    $db=DB::getConnect(); 

    $insert=$db->prepare('INSERT INTO ambiente VALUES (:amb_id, :amb_nombre, :SEDE_sede_id)');
    $insert->bindValue('amb_id',$ambiente->getAmb_id());
    $insert->bindValue('amb_nombre',$ambiente->getAmb_nombre()); 
    $insert->bindValue('SEDE_sede_id',$ambiente->getSEDE_sede_id()); 
    $insert->execute(); 
}
public static function all(){
   $db=DB::getConnect();
   $listaAmbientes=[];
   $select=$db->query('SELECT * FROM ambiente ORDER BY amb_id');
   foreach($select->fetchAll() as $ambiente){
       $listaAmbientes[]=new Ambiente($ambiente['amb_id'],$ambiente['amb_nombre'],$ambiente['SEDE_sede_id']); // capitalized class
   }
   return $listaAmbientes; 
}
public static function searchById($amb_id){
   $db=DB::getConnect();
   $select=$db->prepare('SELECT * FROM ambiente WHERE amb_id=:amb_id');
   $select->bindValue('amb_id',$amb_id);
   $select->execute();

   $ambienteDb=$select->fetch();


   $ambiente = new Ambiente ($ambienteDb['amb_id'],$ambienteDb['amb_nombre'], $ambienteDb['SEDE_sede_id']); // capitalized class
   //var_dump($ambiente);
   //die();
   return $ambiente;
}
public static function update($ambiente){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE ambiente SET amb_nombre=:amb_nombre WHERE amb_id=:amb_id');
    $update->bindValue('amb_nombre', $ambiente->getAmb_nombre());
    $update->bindValue('amb_id',$ambiente->getAmb_id());
    $update->execute();
}
public static function delete($amb_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM ambiente WHERE amb_id=:amb_id');
    $delete->bindValue('amb_id',$amb_id);
    $delete->execute();
}
}
