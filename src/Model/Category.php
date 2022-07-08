<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;
use App\Model\User;
use App\Repository\CategoryRepository;
use App\Rules\CategoryRules;

class Category extends Model
{
    public $id;
    public $user_id;
    public $name;
    public $image;
    public $private;
    public $pages;
    public $relation = false;

    public function __construct()
    {
        $this->rules = new CategoryRules();
        $this->repository = new CategoryRepository();
    }

    public function create(array $data)
    {
        $data['user_id'] = User::ID();

        if ($this->validate($data)) {
            $this->update($data);
            $this->repository->create($this);
            Session::set('success', 'Kategoria została utworzona');
            return true;
        }
        return false;
    }

    public function edit(array $data)
    {
        if ($this->validate($data)) {
            $this->update($data);
            $this->repository->update($this);
            Session::set('success', 'Dane zostały zaktualizowane');
        }
    }

    public function delete($category)
    {
        $this->repository->delete($category);
        Session::set('success', 'Kategoria została usunięta');
    }

    public function author($id): bool
    {
        $category = $this->find(["id" => $id, "user_id" => User::ID()]);
        if (empty($category)) {return false;} else {return true;};
    }

    // @overwrite
    public function find(array $input, $options = "")
    {
        $category = parent::find($input);
        if ($this->relation == true) {
            $category->pages = $this->repository->pages($category);
        }
        return $category;
    }
}
