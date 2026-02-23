<?php 
 class CentroFormacion {
  private  $cent_id;
  private  $cent_nombre;
     public function __construct($cent_id, $cent_nombre){
    $this->cent_id = $cent_id;
    $this->cent_nombre = $cent_nombre;
 }
 public function getCent_id(){
    return $this->cent_id;
 }
 public function setCent_id($cent_id){
    $this->cent_id = $cent_id;
 }
 public function getCent_nombre(){
    return $this->cent_nombre;
 }
 public function setCent_nombre($cent_nombre){
    $this->cent_nombre = $cent_nombre;
 }
 public static function save($centroFormacion){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO centro_formacion VALUES (:cent_id, :cent_nombre)');
    $insert->bindValue('cent_id',$centroFormacion->getCent_id());
    $insert->bindValue('cent_nombre',$centroFormacion->getCent_nombre());
    $insert->execute();
 }
 public static function all(){
    $db=DB::getConnect();
    $listaCentroFormacion=[];
    $select=$db->query('SELECT * FROM centro_formacion ORDER BY cent_id');
    foreach($select->fetchAll() as $centroFormacion){
        $listaCentroFormacion[]=new CentroFormacion($centroFormacion['cent_id'],$centroFormacion['cent_nombre']);
    }
    return $listaCentroFormacion; 
 }
 public static function searchById($cent_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM centro_formacion WHERE cent_id=:cent_id');
    $select->bindValue('cent_id',$cent_id);
    $select->execute();

    $centroFormacionDb=$select->fetch();


    $centroFormacion = new CentroFormacion ($centroFormacionDb['cent_id'],$centroFormacionDb['cent_nombre']);
    //var_dump($centroFormacion);
    //die();
    return $centroFormacion;
 }
 public static function update($centroFormacion){
    $db=DB::getConnect();
    $update=$db->prepare('UPDATE centro_formacion SET cent_nombre=:cent_nombre WHERE cent_id=:cent_id');
    $update->bindValue('cent_nombre', $centroFormacion->getCent_nombre());
    $update->bindValue('cent_id',$centroFormacion->getCent_id());
    $update->execute();
 }
 public static function delete($cent_id){
    $db=DB::getConnect();
    $delete=$db->prepare('DELETE FROM centro_formacion WHERE cent_id=:cent_id');
    $delete->bindValue('cent_id',$cent_id);
    $delete->execute();	
 }
}
