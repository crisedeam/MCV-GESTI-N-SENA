<?php 
class InstruCompetencia {
    private $inscomp_id;
    private $INSTRUCTOR_inst_id;
    private $COMPETxPROGRAMA_PROGRAMA_prog_id;
    private $COMPETxPROGRAMA_COMPETENCIA_comp_id;
    private $inscomp_vigencia;

    public function __construct($inscomp_id, $INSTRUCTOR_inst_id, $COMPETxPROGRAMA_PROGRAMA_prog_id, $COMPETxPROGRAMA_COMPETENCIA_comp_id, $inscomp_vigencia){
        $this->inscomp_id = $inscomp_id;
        $this->INSTRUCTOR_inst_id = $INSTRUCTOR_inst_id;
        $this->COMPETxPROGRAMA_PROGRAMA_prog_id = $COMPETxPROGRAMA_PROGRAMA_prog_id;
        $this->COMPETxPROGRAMA_COMPETENCIA_comp_id = $COMPETxPROGRAMA_COMPETENCIA_comp_id;
        $this->inscomp_vigencia = $inscomp_vigencia;
    }

    public function getInscomp_id(){ return $this->inscomp_id; }
    public function setInscomp_id($inscomp_id){ $this->inscomp_id = $inscomp_id; }
    
    public function getINSTRUCTOR_inst_id(){ return $this->INSTRUCTOR_inst_id; }
    public function setINSTRUCTOR_inst_id($INSTRUCTOR_inst_id){ $this->INSTRUCTOR_inst_id = $INSTRUCTOR_inst_id; }
    
    public function getCOMPETxPROGRAMA_PROGRAMA_prog_id(){ return $this->COMPETxPROGRAMA_PROGRAMA_prog_id; }
    public function setCOMPETxPROGRAMA_PROGRAMA_prog_id($COMPETxPROGRAMA_PROGRAMA_prog_id){ $this->COMPETxPROGRAMA_PROGRAMA_prog_id = $COMPETxPROGRAMA_PROGRAMA_prog_id; }
    
    public function getCOMPETxPROGRAMA_COMPETENCIA_comp_id(){ return $this->COMPETxPROGRAMA_COMPETENCIA_comp_id; }
    public function setCOMPETxPROGRAMA_COMPETENCIA_comp_id($COMPETxPROGRAMA_COMPETENCIA_comp_id){ $this->COMPETxPROGRAMA_COMPETENCIA_comp_id = $COMPETxPROGRAMA_COMPETENCIA_comp_id; }
    
    public function getInscomp_vigencia(){ return $this->inscomp_vigencia; }
    public function setInscomp_vigencia($inscomp_vigencia){ $this->inscomp_vigencia = $inscomp_vigencia; }

    public static function save($instrucomp){
        $db=DB::getConnect();
        $insert=$db->prepare('INSERT INTO instru_competencia (INSTRUCTOR_inst_id, COMPETxPROGRAMA_PROGRAMA_prog_id, COMPETxPROGRAMA_COMPETENCIA_comp_id, inscomp_vigencia) VALUES (:INSTRUCTOR_inst_id, :COMPETxPROGRAMA_PROGRAMA_prog_id, :COMPETxPROGRAMA_COMPETENCIA_comp_id, :inscomp_vigencia)');
        $insert->bindValue('INSTRUCTOR_inst_id',$instrucomp->getINSTRUCTOR_inst_id());
        $insert->bindValue('COMPETxPROGRAMA_PROGRAMA_prog_id',$instrucomp->getCOMPETxPROGRAMA_PROGRAMA_prog_id());
        $insert->bindValue('COMPETxPROGRAMA_COMPETENCIA_comp_id',$instrucomp->getCOMPETxPROGRAMA_COMPETENCIA_comp_id());
        $insert->bindValue('inscomp_vigencia',$instrucomp->getInscomp_vigencia());
        $insert->execute();
    }

    public static function all(){
        $db=DB::getConnect();
        $listaInstruComp=[];
        $select=$db->query('SELECT * FROM instru_competencia ORDER BY inscomp_id');
        foreach($select->fetchAll() as $ic){
            $listaInstruComp[]=new InstruCompetencia($ic['inscomp_id'],$ic['INSTRUCTOR_inst_id'],$ic['COMPETxPROGRAMA_PROGRAMA_prog_id'],$ic['COMPETxPROGRAMA_COMPETENCIA_comp_id'],$ic['inscomp_vigencia']);
        }
        return $listaInstruComp; 
    }

    public static function searchById($inscomp_id){
        $db=DB::getConnect();
        $select=$db->prepare('SELECT * FROM instru_competencia WHERE inscomp_id=:inscomp_id');
        $select->bindValue('inscomp_id',$inscomp_id);
        $select->execute();

        $icDb=$select->fetch();

        if ($icDb) {
            return new InstruCompetencia($icDb['inscomp_id'],$icDb['INSTRUCTOR_inst_id'],$icDb['COMPETxPROGRAMA_PROGRAMA_prog_id'],$icDb['COMPETxPROGRAMA_COMPETENCIA_comp_id'],$icDb['inscomp_vigencia']);
        }
        return null;
    }

    public static function update($instrucomp){
        $db=DB::getConnect();
        $update=$db->prepare('UPDATE instru_competencia SET INSTRUCTOR_inst_id=:INSTRUCTOR_inst_id, COMPETxPROGRAMA_PROGRAMA_prog_id=:COMPETxPROGRAMA_PROGRAMA_prog_id, COMPETxPROGRAMA_COMPETENCIA_comp_id=:COMPETxPROGRAMA_COMPETENCIA_comp_id, inscomp_vigencia=:inscomp_vigencia WHERE inscomp_id=:inscomp_id');
        $update->bindValue('INSTRUCTOR_inst_id', $instrucomp->getINSTRUCTOR_inst_id());
        $update->bindValue('COMPETxPROGRAMA_PROGRAMA_prog_id', $instrucomp->getCOMPETxPROGRAMA_PROGRAMA_prog_id());
        $update->bindValue('COMPETxPROGRAMA_COMPETENCIA_comp_id', $instrucomp->getCOMPETxPROGRAMA_COMPETENCIA_comp_id());
        $update->bindValue('inscomp_vigencia', $instrucomp->getInscomp_vigencia());
        $update->bindValue('inscomp_id',$instrucomp->getInscomp_id());
        $update->execute();
    }

    public static function delete($inscomp_id){
        $db=DB::getConnect();
        $delete=$db->prepare('DELETE FROM instru_competencia WHERE inscomp_id=:inscomp_id');
        $delete->bindValue('inscomp_id',$inscomp_id);
        $delete->execute();	
    }
}
?>
