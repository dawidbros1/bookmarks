<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\Request;
// use App\Repository\CategoryRepository;
// use App\Repository\PageRepository;
// use App\Rules\PageRules;
use App\View;

class PageController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->requireLogin();
        // $this->repository = new PageRepository();
        // $this->categoryRepository = new CategoryRepository();
        // $this->rules = new PageRules();
    }

    public function createAction()
    {
        View::set(['title' => "Tworzenie strony"]);
    }
}
