<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Model\Page;
use App\Repository\Repository;
use PDO;

class PageRepository extends Repository
{
    public function __construct()
    {
        $this->table = "pages";
        parent::__construct();
    }

    public function create(Page $page): void
    {
        $page->escape();

        try {
            $data = [
                'category_id' => $page->category_id,
                'name' => $page->name,
                'image' => $page->image,
                'link' => $page->link,
            ];

            $sql = "INSERT INTO pages (category_id, name, image, link) VALUES (:category_id, :name, :image, :link)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
        } catch (Throwable $e) {
            throw new StorageException('Nie udało się dodać nowej zawartości', 400, $e);
        }
    }

    public function update(Page $page)
    {
        $page->escape();
        $data = [
            'id' => $page->id,
            'name' => $page->name,
            'image' => $page->image,
            'link' => $page->link,
            'category_id' => $page->category_id,
        ];

        $sql = "UPDATE pages SET name=:name, image=:image, link=:link, category_id=:category_id WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute($data);
    }

    public function delete(Page $page)
    {
        $sql = "DELETE FROM pages WHERE id = :id";
        $this->pdo->prepare($sql)->execute(['id' => $page->id]);
    }
}
