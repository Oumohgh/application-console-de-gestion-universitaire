<?php

namespace App\Service;

use App\Entity\User;
use App\Exception\AuthorizationException;
use App\Exception\ValidationException;
use App\Repository\UserRepository;

class AuthService
{
    private UserRepository $userRepository;
    private ?User $currentUser = null;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(string $email, string $password): User
    {
        if (empty(trim($email))) {
            throw new ValidationException("Email is required");
        }
        if (empty(trim($password))) {
            throw new ValidationException("Password is required");
        }

        $user = $this->userRepository->findByEmail(trim($email));
        
        if ($user === null) {
            throw new AuthorizationException("Invalid email or password");
        }

        if (!$user->verifyPassword($password)) {
            throw new AuthorizationException("Invalid email or password");
        }

        $this->currentUser = $user;
        return $user;
    }

    public function logout(): void
    {
        $this->currentUser = null;
    }

    public function getCurrentUser(): ?User
    {
        return $this->currentUser;
    }

    public function isAuthenticated(): bool
    {
        return $this->currentUser !== null;
    }

    public function requireAuthentication(): void
    {
        if (!$this->isAuthenticated()) {
            throw new AuthorizationException("Authentication required");
        }
    }

    public function requireAdmin(): void
    {
        $this->requireAuthentication();
        if (!$this->currentUser->isAdmin()) {
            throw new AuthorizationException("Admin access required");
        }
    }
}

