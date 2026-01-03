<?php

namespace App\Service;

use App\Entity\Student;
use App\Exception\AuthorizationException;
use App\Exception\ValidationException;
use App\Repository\StudentRepository;

class StudentService
{
    private StudentRepository $studentRepository;
    private AuthService $authService;

    public function __construct(StudentRepository $studentRepository, AuthService $authService)
    {
        $this->studentRepository = $studentRepository;
        $this->authService = $authService;
    }

    public function create(
        string $firstName,
        string $lastName,
        string $email,
        int $age,
        string $className
    ): Student {
        $this->authService->requireAdmin();

        $existingStudent = $this->studentRepository->findByEmail($email);
        if ($existingStudent !== null) {
            throw new ValidationException("Student with this email already exists");
        }

        $student = new Student($firstName, $lastName, $email, $age, $className);

        if (!$this->studentRepository->create($student)) {
            throw new ValidationException("Failed to create student");
        }

        return $student;
    }

    public function findById(int $id)
    {
        $this->authService->requireAuthentication();
        return $this->studentRepository->findById($id);
    }

    public function findAll()
    {
        $this->authService->requireAuthentication();
        return $this->studentRepository->findAll();
    }

    public function update(
        int $id,
        $firstName = null,
        $lastName = null,
        $email = null,
        $age = null,
        $className = null
    ) {
        $this->authService->requireAdmin();

        $student = $this->studentRepository->findById($id);
        if ($student === null) {
            throw new ValidationException("Student not found");
        }

        if ($firstName !== null) {
            $student->setFirstName($firstName);
        }
        if ($lastName !== null) {
            $student->setLastName($lastName);
        }
        if ($email !== null) {
            $existingStudent = $this->studentRepository->findByEmail($email);
            if ($existingStudent !== null && $existingStudent->getId() !== $id) {
                throw new ValidationException("Email already in use");
            }
            $student->setEmail($email);
        }
        if ($age !== null) {
            $student->setAge($age);
        }
        if ($className !== null) {
            $student->setClassName($className);
        }

        if (!$this->studentRepository->update($student)) {
            throw new ValidationException("Failed to update student");
        }

        return $student;
    }

    public function delete(int $id): bool
    {
        $this->authService->requireAdmin();

        $student = $this->studentRepository->findById($id);
        if ($student === null) {
            throw new ValidationException("Student not found");
        }

        return $this->studentRepository->delete($id);
    }
}

