<?php

namespace App\Interface;

interface CrudInterface
{
    public function create(object $entity): bool;
    public function findById(int $id): ?object;
    public function findAll(): array;
    public function update(object $entity): bool;
    public function delete(int $id): bool;
}
