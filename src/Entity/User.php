<?php

require_once '/../Abstract/Person.php';
class User extends Person
{
   protected string $tableName = 'users';
   protected string $email;
   protected string $password;
   protected string $role;

    // public function toString (): string
    // {
    //     return "ID: ".$this->getId()
    //         . "\nNOM: " . $this->getNom()
    //         . "\nPRENOM: " . $this->getPrenom()
    //         . "\nEMAIL: " . $this->getEmail()
    //         . "\nPASSWORD: " . $this->getPassword()
    //         . "\nROLE: " . $this->getRole();

    
   public function __construct($firstName,$lastName,$age,$email,$password)
   {
    parent::__construct($firstName,$lastName,$age);
    $this->email = $email;
    $this->password = $password;
   }

}

    // public function toString (): string
    // {
    //     return "ID: ".$this->getId()
    //         . "\nNOM: " . $this->getNom()
    //         . "\nPRENOM: " . $this->getPrenom()
    //         . "\nEMAIL: " . $this->getEmail()
    //         . "\nPASSWORD: " . $this->getPassword()
    //         . "\nROLE: " . $this->getRole();

    
