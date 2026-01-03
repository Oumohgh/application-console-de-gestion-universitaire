<?php

namespace App\Entity;

use App\Abstract\Person;
use App\Exception\ValidationException;

class Student extends Person
{
    private string $className;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        string $className
    ) {
        parent::__construct($firstName, $lastName, $email, $age);
        $this->setClassName($className);
    }

    public function getClassName(): string
    {
        return $this->className;
    }

    public function setClassName(string $className): void
    {
        if (empty(trim($className))) {
            throw new ValidationException("Class name is required");
        }
        $this->className = trim($className);
    }
}
