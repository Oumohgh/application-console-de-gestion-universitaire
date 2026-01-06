<?php

namespace App\Entity;

use App\Abstract\Person;
use App\Exception\ValidationException;

class User extends Person
{
    private string $password;
    private string $role;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_ACADEMIC = 'academic';

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        string $password = '',
        string $role = 'academic'
    ) {
        parent::__construct($firstName, $lastName, $email, $age);
        if ($password !== '') {
            $this->setPassword($password);
        }
        $this->setRole($role);
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        if (empty(trim($password))) {
            throw new ValidationException("Password is required");
        }
        if (strlen($password) < 6) {
            throw new ValidationException("Password must be at least 6 characters");
        }
        $this->password = $password;
    }

    public function setPasswordHash(string $hash): void
    {
        $this->password = $hash;
    }

    public function hashPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $allowedRoles = ['admin', 'academic'];
        if (!in_array($role, $allowedRoles, true)) {
            throw new ValidationException("Invalid role. Must be 'admin' or 'academic'");
        }
        $this->role = $role;
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isAcademic(): bool
    {
        return $this->role === 'academic';
    }
}
