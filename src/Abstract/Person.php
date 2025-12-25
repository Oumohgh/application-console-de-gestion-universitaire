
<?php 
abstract class Person
{
   private $name;
   private $prenom;

    public function getname(){
        return $this->name;
    }

    public function setname($name){
        return $this->name =$name;
    }

     public function getprenom(){
        return $this->prenom;
    }

    public function setprenom($prenom){
        return $this->prenom =$prenom;
    }

}



?>




