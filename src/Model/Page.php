<?php

declare (strict_types = 1);

namespace App\Model;

use App\Repository\PageRepository;
use App\Rules\PageRules;

class Page extends Model
{
    public $fillable = ['id', 'category_id', 'name', 'image', 'link'];
    private static $config;

    public function __construct()
    {
        $this->rules = new PageRules();
        $this->repository = new PageRepository();
    }
}
