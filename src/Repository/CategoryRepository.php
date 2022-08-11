<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Model\Page;
use App\Repository\Repository;
use PDO;

class CategoryRepository extends Repository
{
    public function __construct()
    {
        $this->table = "categories";
        parent::__construct();
    }

    // Relations
    public function deletePages($category_id)
    {
        $sql = "DELETE FROM pages WHERE category_id = :category_id";
        $this->pdo->prepare($sql)->execute(['category_id' => $category_id]);
    }

    public function pages(int $category_id)
    {
        $pages = [];
        $stmt = $this->pdo->prepare("SELECT * FROM pages WHERE category_id=:category_id ORDER BY name ASC");
        $stmt->execute(['category_id' => $category_id]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($data)) {
            foreach ($data as $properties) {
                $pages[] = new Page($properties);
            }
        }

        return $pages;
    }
}
