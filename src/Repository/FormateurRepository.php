<?php


include'src\Database\DatabaseConnection.php';

class FormateurRepository {

    private $conn;

    public function __construct()
    {
        $this->conn =new DatabaseConnection()->connect();
    }

    

  
    public function delete(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM users WHERE id = :id")
            ->execute(['id' => $id]);
    }
}
}