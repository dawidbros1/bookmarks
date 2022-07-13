<?php

declare (strict_types = 1);

namespace App\Repository;

use PDO;

class AuthRepository extends Repository
{
    public function __construct()
    {
        $this->table = "users";
        parent::__construct();
    }

    public function login(string $email, string $password): ?int
    {
        $id = null;
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE email=:email AND password=:password");
        $stmt->execute([
            'email' => $email,
            'password' => $password,
        ]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {$id = (int) $data['id'];}
        return $id;
    }

    public function getEmails(): array
    {
        $stmt = $this->pdo->prepare("SELECT email FROM users");
        $stmt->execute();
        $emails = $stmt->fetchAll(PDO::FETCH_COLUMN, 'email');
        return $emails;
    }
}
