<?php

require_once 'User.php';

 
class Student extends User{

  protected string $tableName = 'students';
  protected string $nameclass;
  
   public function __construct(string $firstName,string $lastName,INT $Age ,string $nameclass)
  {
     parent::__construct($firstName, $lastName, $Age);
     $this->$nameclass = $nameclass ;
  }
  public function gettableName(){
    return $this->tableName;
  }

  public function getNameclass()
  {
    return $this->nameclass;
  }

  public function setNameclass($nameclass)
  {
    $this->nameclass = $nameclass;

    return $this;
  }
}

//     public function toString (): string
//     {
//         return "id: ".$this->getId(). "\nnom: " . $this->getNom() . "\nprenom: " . $this->getPrenom(). "\nemail: " . $this->getEmail() . "\ncarte : " . $this->getCNE();

//     }
// }
