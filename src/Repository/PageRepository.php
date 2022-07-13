<?php

declare (strict_types = 1);

namespace App\Repository;

use App\Repository\Repository;

class PageRepository extends Repository
{
    public function __construct()
    {
        $this->table = "pages";
        parent::__construct();
    }
}
