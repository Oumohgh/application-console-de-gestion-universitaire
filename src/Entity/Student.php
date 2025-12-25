<?php

require_once "User.php";

class Student extends User
{
    private int $departmentId;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        int $departmentId
    ) {
        parent::__construct($firstName, $lastName, $email, $password, "STUDENT");
        $this->setDepartmentId($departmentId);
    }


    public function getDepartmentId(): int { return $this->departmentId; }


    public function setDepartmentId(int $departmentId): void
    {
        $this->departmentId = $departmentId;
    }
}




//     public function toString (): string
//     {
//         return "id: ".$this->getId(). "\nnom: " . $this->getNom() . "\nprenom: " . $this->getPrenom(). "\nemail: " . $this->getEmail() . "\ncarte : " . $this->getCNE();

//     }
// }
