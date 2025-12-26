<?php 
class DepartmentService{
    private $table =[];

   public function criteDepartome(Departement $department){
    array_push($this->table,$department);
   } 

   public function upditedepartement($id,$name,$description){
    foreach($this->table as $key => $dep){
        if($dep->getId ===$id){
            $dep->setname($name);
            $dep->setdescription($description);
        }
    }
   }

   public function getDapa(){
    return $this->table;
   }
}