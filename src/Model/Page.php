<?php

declare (strict_types = 1);

namespace App\Model;

use App\Helper\Session;

class Page extends Model
{
    public $fillable = ['id', 'category_id', 'name', 'image', 'link'];
    private static $config;

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
