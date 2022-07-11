<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Model\User;
use App\Repository\Repository;
use PDO;

class UserRepository extends Repository
{
    public function __construct()
    {
        $this->table = "users";
        parent::__construct();
    }

    public function updateProperty(User $user, string $property): void
    {
        $user->escape();
        $data = $user->getArray(['id', $property]);
        $sql = "UPDATE $this->table SET $property=:$property WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($data);
    }
}
