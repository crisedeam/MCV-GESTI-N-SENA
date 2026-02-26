<?php 
 class CentroFormacion {
  private  $cent_id;
  private  $cent_nombre;
  private $cent_correo;
  private $cent_password;

     public function __construct($cent_id, $cent_nombre, $cent_correo = null, $cent_password = null){
    $this->cent_id = $cent_id;
    $this->cent_nombre = $cent_nombre;
    $this->cent_correo = $cent_correo;
    $this->cent_password = $cent_password;
 }
 public function getCent_id(){ return $this->cent_id; }
 public function setCent_id($cent_id){ $this->cent_id = $cent_id; }
 public function getCent_nombre(){ return $this->cent_nombre; }
 public function setCent_nombre($cent_nombre){ $this->cent_nombre = $cent_nombre; }
 public function getCent_correo() { return $this->cent_correo; }
 public function setCent_correo($cent_correo) { $this->cent_correo = $cent_correo; }
 public function getCent_password() { return $this->cent_password; }
 public function setCent_password($cent_password) { $this->cent_password = $cent_password; }

 public static function save($centroFormacion){
    $db=DB::getConnect();
    $insert=$db->prepare('INSERT INTO centro_formacion (cent_id, cent_nombre, cent_correo, cent_password) VALUES (:cent_id, :cent_nombre, :cent_correo, :cent_password)');
    $insert->bindValue('cent_id',$centroFormacion->getCent_id());
    $insert->bindValue('cent_nombre',$centroFormacion->getCent_nombre());
    $insert->bindValue('cent_correo', $centroFormacion->getCent_correo());
    
    // Hash password if not empty
    $hashedPassword = !empty($centroFormacion->getCent_password()) ? password_hash($centroFormacion->getCent_password(), PASSWORD_DEFAULT) : null;
    $insert->bindValue('cent_password', $hashedPassword);
    
    $insert->execute();
 }
 public static function all(){
    $db=DB::getConnect();
    $listaCentroFormacion=[];
    $select=$db->query('SELECT * FROM centro_formacion ORDER BY cent_id');
    foreach($select->fetchAll() as $cf){
        $listaCentroFormacion[]=new CentroFormacion($cf['cent_id'],$cf['cent_nombre'],$cf['cent_correo'],$cf['cent_password']);
    }
    return $listaCentroFormacion; 
 }
 public static function searchById($cent_id){
    $db=DB::getConnect();
    $select=$db->prepare('SELECT * FROM centro_formacion WHERE cent_id=:cent_id');
    $select->bindValue('cent_id',$cent_id);
    $select->execute();

    $cfDb=$select->fetch();

    if ($cfDb) {
        return new CentroFormacion ($cfDb['cent_id'],$cfDb['cent_nombre'],$cfDb['cent_correo'],$cfDb['cent_password']);
    }
    return null;
 }
 public static function update($centroFormacion){
    $db=DB::getConnect();
    
    if (!empty($centroFormacion->getCent_password())) {
        $update=$db->prepare('UPDATE centro_formacion SET cent_nombre=:cent_nombre, cent_correo=:cent_correo, cent_password=:cent_password WHERE cent_id=:cent_id');
        $hashedPassword = password_hash($centroFormacion->getCent_password(), PASSWORD_DEFAULT);
        $update->bindValue('cent_password', $hashedPassword);
    } else {
        $update=$db->prepare('UPDATE centro_formacion SET cent_nombre=:cent_nombre, cent_correo=:cent_correo WHERE cent_id=:cent_id');
    }

    $update->bindValue('cent_nombre', $centroFormacion->getCent_nombre());
    $update->bindValue('cent_correo', $centroFormacion->getCent_correo());
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
