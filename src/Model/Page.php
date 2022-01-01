<?php

declare (strict_types = 1);

namespace App\Model;

class Page extends Model
{
    public $id;
    public $category_id;
    public $name;
    public $image;
    public $link;

    private static $config;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->category_id = $data['category_id'];
        $this->name = $data['name'];
        $this->image = $data['image'];
        $this->link = $data['link'];
    }
}
