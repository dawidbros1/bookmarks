<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;

class Category extends Model
{
    public $relation = false;
    public $fillable = ['id', 'user_id', 'name', 'image', 'private'];

    # @overwrite
    # Method create category    
    public function create(array $data, $validate = true)
    {
        if ($status = parent::create($data, $validate)) {
            Session::success("Kategoria została dodana");
        }

        return $status;
    }

    # @overwrite
    # Method delete category with pages
    public function delete(?int $id = null)
    {
        $this->repository->deletePages($this->id);
        parent::delete();
        Session::success('Kategoria ' . $this->name . ' została usunięta');
    }

    # @overwrite
    # Method returns category (with pages if $relation == true)
    public function find(array $input, $options = "", $onlyFillable = false)
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
