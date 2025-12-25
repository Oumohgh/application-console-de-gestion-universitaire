<?php

namespace App\Abstract;

abstract class Person
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $email;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email
    ) {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
    }

    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    protected function setFirstName(string $firstName): void
    {
        if (empty($firstName)) {
            throw new \InvalidArgumentException("First name is required");
        }
        $this->firstName = $firstName;
    }

    protected function setLastName(string $lastName): void
    {
        if (empty($lastName)) {
            throw new \InvalidArgumentException("Last name is required");
        }
        $this->lastName = $lastName;
    }

    protected function setEmail(string $email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Invalid email");
        }
        $this->email = $email;
    }
}
