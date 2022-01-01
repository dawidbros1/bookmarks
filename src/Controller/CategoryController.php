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
            $data['user_id'] = $this->user->id;

            if ($this->validate($data, $this->rules)) {
                $category = new Category($data);
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
        View::set(['title' => "Moje kategorie", 'style' => 'item']);
        $categories = $this->repository->getAll($this->user->id);
        $this->view->render('category/list', ['categories' => $categories]);
    }

    public function editAction()
    {
        View::set(['title' => "Edycja kategorii"]);
        $category = $this->category();
        $names = ['name', 'image'];

        if ($this->request->isPost() && $this->request->hasPostNames($names)) {
            $data = $this->request->postParams($names);
            $data['private'] = CheckBox::get($this->request->postParam('private', false));

            if ($this->validate($data, $this->rules)) {
                $category->update($data);
                $this->repository->update($category);
                Session::set('success', 'Kategoria została zaktualizowana');
            }

            $this->redirect(self::$route->get('category.edit') . "&id=" . $category->id);
        } else {
            $this->view->render("category/edit", ['category' => $category]);
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $category = $this->category();
            $this->repository->delete($category);
            Session::set('success', 'Kategoria usunięta');
        } else {
            Session::set('error', 'Błąd dostępu do wybranej akcji');
        }

        $this->redirect(self::$route->get('category.list'));
    }

    // =====

    private function category()
    {
        $error = false;

        if ($this->request->isPost()) {
            $id = $this->request->postParam('id');
        } else {
            $id = $this->request->getParam('id');
        }

        if ($id == null) {
            Session::set('error', 'Brak identyfikatora kategorii');
            $error = true;
        }

        if ($error == false && !$category = $this->repository->get((int) $id)) {
            Session::set('error', 'Kategoria o podanym ID nie istnieje');
            $error = true;
        }

        if ($error == false && $category->user_id != $this->user->id) {
            Session::set('error', 'Podana kategorie nie należy do ciebie');
            $error = true;
        }

        if ($error == true) {
            $this->redirect(self::$route->get('category.list'));
        } else {
            return $category;
        }
    }
}
