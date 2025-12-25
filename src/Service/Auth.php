<?php

session_start();

class Auth
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function login(string $email, string $password): bool
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);

        if ($stmt->rowCount() === 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                return true;
            }
        }
        return false;
    }


    public function register(
        string $firstName,
        string $lastName,
        string $email,
        string $password,
        string $role = 'STUDENT'
    ): bool {
      
        $check = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            throw new Exception("Email already exists");
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (first_name, last_name, email, password, role)
                VALUES (?, ?, ?, ?, ?)";

        return $this->db->prepare($sql)->execute([
            $firstName,
            $lastName,
            $email,
            $hashedPassword,
            $role
        ]);
    }

    public function logout(): void
    {
        session_unset();
        session_destroy();
    }

  
    public function isLogged(): bool
    {
        return isset($_SESSION['user']);
    }

    public function getUser(): ?array
    {
        return $_SESSION['user'] ?? null;
    }
}
?>