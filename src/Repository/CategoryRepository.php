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
        $category->escape();

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

    public function get(int $id)
    {
        $category = null;
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data != false) {$category = new Category($data);}
        return $category;
    }

    public function update(Category $category)
    {
        $category->escape();
        $data = [
            'id' => $category->id,
            'name' => $category->name,
            'image' => $category->image,
            'private' => $category->private,
        ];

        $sql = "UPDATE categories SET name=:name, image=:image, private=:private WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($data);
    }

    public function delete(Category $category)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $this->pdo->prepare($sql)->execute(['id' => $category->id]);
    }
}
