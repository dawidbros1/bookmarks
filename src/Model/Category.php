<?php

declare (strict_types = 1);

namespace App\Model;

class Category extends Model
{
    public $id;
    public $name;
    public $image;
    public $private;

    private static $config;

    public function __construct($data)
    {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'];
        $this->image = $data['image'];
        $this->private = $data['private'];
    }
}
