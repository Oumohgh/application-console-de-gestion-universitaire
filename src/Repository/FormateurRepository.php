<?php

namespace App\Repository;

use App\Database\DatabaseConnection;
use App\Entity\Formateur;
use PDO;

class FormateurRepository
{
    private PDO $pdo;
    private string $tableName = 'formateurs';

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getConnection();
    }

    public function create(object $entity): bool
    {
        if (!$entity instanceof Formateur) {
            return false;
        }

        $sql = "INSERT INTO {$this->tableName} (firstname, lastname, email, age, speciality) 
                VALUES (:firstname, :lastname, :email, :age, :speciality)";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':firstname', $entity->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $entity->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $entity->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':age', $entity->getAge(), PDO::PARAM_INT);
        $stmt->bindValue(':speciality', $entity->getSpeciality(), PDO::PARAM_STR);

        if ($stmt->execute()) {
            $entity->setId((int)$this->pdo->lastInsertId());
            return true;
        }
        return false;
    }

    public function findById(int $id)
    {
        $sql = "SELECT id, firstname, lastname, email, age, speciality 
                FROM {$this->tableName} WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->creerDepuisDonnees($data);
    }

    public function findByEmail(string $email)
    {
        $sql = "SELECT id, firstname, lastname, email, age, speciality 
                FROM {$this->tableName} WHERE email = :email";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$data) {
            return null;
        }

        return $this->creerDepuisDonnees($data);
    }

    public function findAll()
    {
        $sql = "SELECT id, firstname, lastname, email, age, speciality 
                FROM {$this->tableName} ORDER BY id";
        
        $stmt = $this->pdo->query($sql);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $formateurs = [];
        foreach ($results as $data) {
            $formateurs[] = $this->creerDepuisDonnees($data);
        }

        return $formateurs;
    }

    public function update(object $entity): bool
    {
        if (!$entity instanceof Formateur) {
            return false;
        }

        if ($entity->getId() === null) {
            return false;
        }

        $sql = "UPDATE {$this->tableName} 
                SET firstname = :firstname, lastname = :lastname, email = :email, 
                    age = :age, speciality = :speciality 
                WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $entity->getId(), PDO::PARAM_INT);
        $stmt->bindValue(':firstname', $entity->getFirstName(), PDO::PARAM_STR);
        $stmt->bindValue(':lastname', $entity->getLastName(), PDO::PARAM_STR);
        $stmt->bindValue(':email', $entity->getEmail(), PDO::PARAM_STR);
        $stmt->bindValue(':age', $entity->getAge(), PDO::PARAM_INT);
        $stmt->bindValue(':speciality', $entity->getSpeciality(), PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function creerDepuisDonnees($data)
    {
        $formateur = new Formateur(
            $data['firstname'],
            $data['lastname'],
            $data['email'],
            (int)$data['age'],
            $data['speciality']
        );
        $formateur->setId((int)$data['id']);
        return $formateur;
    }
}
