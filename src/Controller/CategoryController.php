<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\CheckBox;
use App\Helper\Request;
use App\Helper\Session;
use App\Model\Category;
use App\Repository\CategoryRepository;
use App\Rules\CategoryRules;
use App\View;

class CategoryController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->requireLogin();
        $this->repository = new CategoryRepository();
        $this->rules = new CategoryRules();
    }

    public function createAction()
    {
        View::set(['title' => "Tworzenie kategorii"]);
        $names = ['name', 'image'];

        if ($this->request->isPost() && $this->request->hasPostNames($names)) {
            $data = $this->request->postParams($names);
            $data['private'] = CheckBox::get($this->request->postParam('private', false));

            if ($this->validate($data, $this->rules)) {
                $category = new Category($data);
                $category->escape();
                $this->repository->create($category);
                Session::set('success', 'Kategoria została utworzona');
            }

            $this->redirect(self::$route->get('category.create'));
        } else {
            $this->view->render('category/create');
        }
    }

    public function listAction()
    {
        View::set(['style' => 'item']);
        $categories = $this->repository->getAll();
        $this->view->render('category/list', ['categories' => $categories]);
    }
}
