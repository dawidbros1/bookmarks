<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Model\Category;
use App\Repository\Repository;
use PDO;

class CategoryRepository extends Repository
{
    public function create(Category $category): void
    {
        try {
            $data = [
                'user_id' => $category->user_id,
                'name' => $category->name,
                'image' => $category->image,
                'private' => $category->private,
            ];

            $sql = "INSERT INTO categories (name, user_id, image, private) VALUES (:name, :user_id, :image, :private)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
        } catch (Throwable $e) {
            throw new StorageException('Nie udało się dodać nowej kategorii', 400, $e);
        }
    }

    public function getAll(int $user_id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE user_id=:user_id");
        $stmt->execute(['user_id' => $user_id]);

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $categories = [];

        foreach ($data as $item) {
            $categories[] = new Category($item);
        }

        return $categories;
    }
}
