<?php

namespace App\Abstract;

use App\Exception\ValidationException;

abstract class Person
{
    protected int $id ;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    protected int $age;

    public function __construct(string $firstName, string $lastName, string $email, int $age)
    {
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setAge($age);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setFirstName(string $firstName): void
    {
        if (empty(trim($firstName))) {
            throw new ValidationException("First name is required");
        }
        if (strlen($firstName) < 2) {
            throw new ValidationException("First name must be at least 2 characters");
        }
        $this->firstName = trim($firstName);
    }

    public function setLastName(string $lastName): void
    {
        if (empty(trim($lastName))) {
            throw new ValidationException("Last name is required");
        }
        if (strlen($lastName) < 2) {
            throw new ValidationException("Last name must be at least 2 characters");
        }
        $this->lastName = trim($lastName);
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        if (empty($email)) {
            throw new ValidationException("Email is required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new ValidationException("Invalid email format");
        }
        $this->email = $email;
    }

    public function setAge(int $age): void
    {
        if ($age < 0 || $age > 150) {
            throw new ValidationException("Age must be between 0 and 150");
        }
        $this->age = $age;
    }

    public function getFullName(): string
    {
        return $this->firstName . " " . $this->lastName;
    }
}