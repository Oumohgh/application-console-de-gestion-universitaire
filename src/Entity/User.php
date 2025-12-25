<?php

namespace App\Entity;

use App\Abstract\Person;

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

        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->role = $role;
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getRole(): string
    {
        return $this->role;
    }
}
