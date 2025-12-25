<?php

namespace App\Entity;

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
        parent::__construct(
            $firstName,
            $lastName,
            $email,
            $password,
            'STUDENT'
        );

        $this->departmentId = $departmentId;
    }

    public function getDepartmentId(): int
    {
        return $this->departmentId;
    }
}
