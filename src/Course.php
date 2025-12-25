<?php 
class Course 
{
    public $id;
    public $titre;
    public $volumeHoraire;
    public $departmentId;

    public function __construct($id,$titre,$volumeHoraire,$departmentId)
    {
        $this->id=$id;
        $this->titre=$titre;
        $this->volumeHoraire =$volumeHoraire;
        $this->departmentId =$departmentId;
    }

    public function getid(){
        return $this->id;
    }

    public function setid($id){
        if(!is_int($id) || $id<0 || $id==''){
            echo "dkhl id shih";
            exit();
        }
        return $this->id =$id;
    }

    public function getTitre(){
        return $this->titre;
    }

    public function setTitre($titre){
        if(!is_string($titre) || empty($titre)){
            echo "3mr titre";
            exit();
        }
        return $this->titre =$titre;
    }

    public function getVolumeHoraire(){
        return $this->volumeHoraire;
    }

    public function setVolumeHoraire($volumeHoraire){
         if(!is_int($volumeHoraire) ||$volumeHoraire==''){
            echo "dkhl 3dad sa3at shih";
            exit();
         }
        return $this->volumeHoraire =$volumeHoraire;
    }

     public function getdepartmentId(){
        return $this->departmentId;
    }

    public function setdepartmentId($departmentId){
        if(!is_int($departmentId) ||$departmentId==''){
            echo "dkhl volumeHoraire shih";
            exit();
        }
        return $this->departmentId =$departmentId;
    }

}

$cour =new Course(3,"almofid",2,5);
echo $cour->getid();
echo "\n";
//$cour->setid(-3);
echo $cour->getTitre();
echo "\n";
echo $cour->getVolumeHoraire();
echo "\n";
echo $cour->getdepartmentId();