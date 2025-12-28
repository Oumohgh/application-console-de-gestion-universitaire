<?php

require_once "User.php";

class Formateur extends User
{
    private string $specialty;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $specialty
    ) {
        parent::__construct($firstName, $lastName, $email, $password, "FORMATEUR");
        $this->setSpecialty($specialty);
    }

    // Getter
    public function getSpecialty(): string
    {return $this->specialty;}

    // Setter
    public function setSpecialty(string $specialty): void
    {
        $this->specialty = $specialty;
    }
}

// public function toString (): string
// {
//     return "id ".$this->getId() . "\nom: " . $this->getNom()  . "\nprenom " . $this->getPrenom() . "\nemail " . $this->getEmail()     . "\nSPECIALITE: " . $this-> getSpecialite();

// }
