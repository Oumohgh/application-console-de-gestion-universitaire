<?php

require_once "Person.php";

class User extends Person
{
    protected string $password;
    protected string $role;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $role
    ) {
        parent::__construct($firstName, $lastName, $email);
        $this->setPassword($password);
        $this->setRole($role);
    }

    
    public function getPassword(): string { return $this->password; }
    public function getRole(): string { return $this->role; }

    
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
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

    
