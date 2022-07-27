<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;
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

    // @overwrite //
    public function create(array $data, $validate = true)
    {
        if (parent::create($data, $validate)) {
            Session::success("Strona została dodana");
        }
    }

    // @overwrite //
    public function delete(?int $id = null)
    {
        parent::delete();
        Session::success('Strona ' . $this->name . ' została usunięta');
    }
}
