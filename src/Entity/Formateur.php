<?php



require_once '/../Abstract/Person.php';
class Formateur extends Person
{
  protected string $tableName = 'formateurs';
  protected string $specialise;

  public function __construct(string $firstName,string $lastName,INT $Age,string $specialise)
  {
     parent::__construct($firstName, $lastName, $Age);
     $this->specialise = $specialise;
  }
}
// public function toString (): string
// {
//     return "id ".$this->getId() . "\nom: " . $this->getNom()  . "\nprenom " . $this->getPrenom() . "\nemail " . $this->getEmail()     . "\nSPECIALITE: " . $this-> getSpecialite();

// }
