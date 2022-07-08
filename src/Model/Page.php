<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;
use App\Repository\PageRepository;
use App\Rules\PageRules;

class Page extends Model
{
    public $id;
    public $category_id;
    public $name;
    public $image;
    public $link;

    private static $config;

    public function __construct()
    {
        $this->rules = new PageRules();
        $this->repository = new PageRepository();
    }

    public function create(array $data)
    {
        if ($this->validate($data)) {
            $this->update($data);
            $this->repository->create($this);
            Session::set('success', 'Strona została utworzona');
        }
    }

    public function edit(array $data)
    {
        if ($this->validate($data)) {
            $this->update($data);
            $this->repository->update($this);
            Session::set('success', 'Dane zostały zaktualizowane');
            return true;
        }
        return false;
    }

    public function delete()
    {
        $this->repository->delete($this);
        Session::set('success', 'Strona została usunięta');
    }

    public function author()
    {

    }
}
