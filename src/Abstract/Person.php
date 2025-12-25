<?php

abstract class Person
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $email;

    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
    }

  
    public function getId(): int { 
        return $this->id; }
    public function getFirstName(): string { 
        return $this->firstName; }
    public function getLastName(): string { 
        return $this->lastName; }
    public function getEmail(): string {
         return $this->email; }

    public function setFirstName(string $firstName): void{
        if (empty($firstName)) {
            throw new Exception("First name required");
        }
        $this->firstName = $firstName;
    }

    public function setLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new Exception("Last name required");
        }
        $this->lastName = $lastName;
    }

    public function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email");
        }
        $this->email = $email;
    }

    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
}
?>