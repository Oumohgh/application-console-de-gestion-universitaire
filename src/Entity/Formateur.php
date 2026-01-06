<?php

namespace App\Entity;

use App\Abstract\Person;
use App\Exception\ValidationException;

class Formateur extends Person
{
    private string $speciality;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        string $speciality
    ) {
        parent::__construct($firstName, $lastName, $email, $age);
        $this->setSpeciality($speciality);
    }

    public function getSpeciality(): string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): void
    {
        if (empty(trim($speciality))) {
            throw new ValidationException("Speciality is required");
        }
        $this->speciality = trim($speciality);
    }
}
// public function toString (): string
// {
//     return "id ".$this->getId() . "\nom: " . $this->getNom()  . "\nprenom " . $this->getPrenom() . "\nemail " . $this->getEmail()     . "\nSPECIALITE: " . $this-> getSpecialite();

// }
