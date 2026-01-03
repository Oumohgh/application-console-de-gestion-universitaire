<?php

namespace App\Service;

use App\Entity\Formateur;
use App\Exception\AuthorizationException;
use App\Exception\ValidationException;
use App\Repository\FormateurRepository;

class FormateurService
{
    private FormateurRepository $formateurRepository;
    private AuthService $authService;

    public function __construct(FormateurRepository $formateurRepository, AuthService $authService)
    {
        $this->formateurRepository = $formateurRepository;
        $this->authService = $authService;
    }

    public function create(string $firstName,string $lastName,string $email, int $age,string $speciality): Formateur {
        $this->authService->requireAdmin();

        $existingFormateur = $this->formateurRepository->findByEmail($email);
        if ($existingFormateur !== null) {
            throw new ValidationException("Formateur with this email already exists");
        }

        $formateur = new Formateur($firstName, $lastName, $email, $age, $speciality);

        if (!$this->formateurRepository->create($formateur)) {
            throw new ValidationException("Failed to create formateur");
        }

        return $formateur;
    }

    public function findById(int $id)
    {
        $this->authService->requireAuthentication();
        return $this->formateurRepository->findById($id);
    }

    public function findAll()
    {
        $this->authService->requireAuthentication();
        return $this->formateurRepository->findAll();
    }

    public function update(int $id,$firstName = null,$lastName = null,$email = null,$age = null,$speciality = null
    ) {
        $this->authService->requireAdmin();

        $formateur = $this->formateurRepository->findById($id);
        if ($formateur === null) {
            throw new ValidationException("Formateur not found");
        }

        if ($firstName !== null) {
            $formateur->setFirstName($firstName);
        }
        if ($lastName !== null) {
            $formateur->setLastName($lastName);
        }
        if ($email !== null) {
            $existingFormateur = $this->formateurRepository->findByEmail($email);
            if ($existingFormateur !== null && $existingFormateur->getId() !== $id) {
                throw new ValidationException("Email already in use");
            }
            $formateur->setEmail($email);
        }
        if ($age !== null) {
            $formateur->setAge($age);
        }
        if ($speciality !== null) {
            $formateur->setSpeciality($speciality);
        }

        if (!$this->formateurRepository->update($formateur)) {
            throw new ValidationException("Failed to update formateur");
        }

        return $formateur;
    }

    public function delete(int $id): bool
    {
        $this->authService->requireAdmin();

        $formateur = $this->formateurRepository->findById($id);
        if ($formateur === null) {
            throw new ValidationException("Formateur not found");
        }

        return $this->formateurRepository->delete($id);
    }
}

