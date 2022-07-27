<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;
use App\Repository\CategoryRepository;
use App\Rules\CategoryRules;

class Category extends Model
{
    public $relation = false;
    public $fillable = ['id', 'user_id', 'name', 'image', 'private'];

    public function __construct()
    {
        $this->rules = new CategoryRules();
        $this->repository = new CategoryRepository();
    }

    // @overwrite //
    public function create(array $data, $validate = true)
    {
        if (parent::create($data, $validate)) {
            Session::success("Kategoria została dodana");
        }
    }

    // @overwrite //
    public function delete(?int $id = null)
    {
        $this->repository->deletePages($this->id);
        parent::delete();
        Session::success('Kategoria ' . $this->name . ' została usunięta');
    }

    // @overwrite //
    public function find(array $input, $options = "")
    {
        $category = parent::find($input);

        if ($category != null) {
            if ($this->relation == true) {
                $category->pages = $this->repository->pages((int) $category->id);
            } else {
                $category->pages = [];
            }
        }

        return $category;
    }
}
