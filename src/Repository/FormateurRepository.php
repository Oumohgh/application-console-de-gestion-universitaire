<?php




class FormateurRepository implements CrudInterface
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = DatabaseConnection::getConnection();
    }

    

  
    public function delete(int $id): bool
    {
        return $this->pdo
            ->prepare("DELETE FROM users WHERE id = :id")
            ->execute(['id' => $id]);
    }
}
