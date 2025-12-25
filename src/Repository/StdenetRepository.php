<?php

;

class StudentRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getConnection();
    }

  
    public function create(object $entity): bool
    {
        

        $sql = "INSERT INTO users (first_name, last_name, email, password, role)
                VALUES (:first_name, :last_name, :email, :password, 'STUDENT')";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'first_name' => $entity->getFirstName(),
            'last_name'  => $entity->getLastName(),
            'email'      => $entity->getEmail(),
            'password'   => $entity->getPassword()
        ]);

        $userId = $this->pdo->lastInsertId();

        $sql = "INSERT INTO students (user_id, department_id)
                VALUES (:user_id, :department_id)";

        return $this->pdo->prepare($sql)->execute([
            'user_id' => $userId,
            'department_id' => $entity->getDepartmentId()
        ]);
    }

    
    public function findById(int $id): ?Student
    {
        $sql = "SELECT u.*, s.department_id
                FROM users u
                JOIN students s ON s.user_id = u.id
                WHERE u.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $data = $stmt->fetch();

        if (!$data) {
            return null;
        }

        return new Student(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['department_id']
        );
    }

    public function findAll(): array
    {
        $sql = "SELECT u.*, s.department_id
                FROM users u
                JOIN students s ON s.user_id = u.id";

        $stmt = $this->pdo->query($sql);
        $students = [];

        while ($row = $stmt->fetch()) {
            $students[] = new Student(
                $row['first_name'],
                $row['last_name'],
                $row['email'],
                $row['password'],
                $row['department_id']
            );
        }

        return $students;
    }

    public function update(object $entity): bool
    {
       
        $sql = "UPDATE users SET
                first_name = :first_name,
                last_name = :last_name,
                email = :email
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'first_name' => $entity->getFirstName(),
            'last_name'  => $entity->getLastName(),
            'email'      => $entity->getEmail(),
            'id'         => $entity->getId()
        ]);

        $sql = "UPDATE students SET department_id = :department_id
                WHERE user_id = :id";

        return $this->pdo->prepare($sql)->execute([
            'department_id' => $entity->getDepartmentId(),
            'id' => $entity->getId()
        ]);
    }

   
    public function delete(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        return $this->pdo->prepare($sql)->execute(['id' => $id]);
    }
}
