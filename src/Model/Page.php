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

    public function __construct(array $data = [])
    {
        $this->rules = new PageRules();
        $this->repository = new PageRepository();
        $this->set($data);
    }

    // @overwrite //
    public function create(array $data, $validate = true)
    {
        if ($status = parent::create($data, $validate)) {
            Session::success("Strona została dodana");
        }

        return $status;
    }

    // @overwrite //
    public function delete(?int $id = null)
    {
        parent::delete();
        Session::success('Strona ' . $this->name . ' została usunięta');
    }
}
