<?php

declare (strict_types = 1);

namespace App\Repository;

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

    // public function delete(Category $category)
    // {
    //     $this->deletePages($category->id);
    //     $sql = "DELETE FROM categories WHERE id = :id";
    //     $this->pdo->prepare($sql)->execute(['id' => $category->id]);
    // }

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

    public function pages(int $category_id)
    {
        $page = new Page();
        $pages = [];
        $stmt = $this->pdo->prepare("SELECT * FROM pages WHERE category_id=:category_id ORDER BY name ASC");
        $stmt->execute(['category_id' => $category_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            foreach ($data as $item) {
                $page->set($item);
                $pages[] = clone $page;
            }
        }

        return $pages;
    }
}
