<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Model\Category;
use App\Model\Page;
use App\Model\User;
use App\Repository\Repository;
use PDO;

class CategoryRepository extends Repository
{
    public function __construct()
    {
        $this->table = "categories";
        parent::__construct();
    }

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
            throw new StorageException('Nie udało się dodać nowej zawartości', 400, $e);
        }
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
        $this->deletePages($category->id);
        $sql = "DELETE FROM categories WHERE id = :id";
        $this->pdo->prepare($sql)->execute(['id' => $category->id]);
    }

    public function author(int $id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE id=:id AND user_id=:user_id");
        $stmt->execute(['id' => $id, 'user_id' => User::ID()]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($data)) {return false;} else {return true;};
    }

    // Relations
    public function deletePages($category_id)
    {
        $sql = "DELETE FROM pages WHERE category_id = :category_id";
        $this->pdo->prepare($sql)->execute(['category_id' => $category_id]);
    }

    public function pages(Category $category)
    {
        $page = new Page();
        $pages = [];
        $stmt = $this->pdo->prepare("SELECT * FROM pages WHERE category_id=:category_id ORDER BY name ASC");
        $stmt->execute(['category_id' => $category->id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            foreach ($data as $item) {
                $page->update($item);
                $pages[] = clone $page;
            }
        }

        return $pages;
    }
}
