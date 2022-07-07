<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\CheckBox;
use App\Helper\Request;
use App\Helper\Session;
use App\Model\Category;
use App\Model\User;
use App\View;

class CategoryController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);

        if ($this->request->getParam('action') != "public") {
            $this->requireLogin();
        }

        $this->model = new Category();
    }

    public function createAction()
    {
        View::set(['title' => "Tworzenie kategorii"]);
        $names = ['name', 'image'];

        if ($this->request->isPost() && $this->request->hasPostNames($names)) {
            $data = $this->request->postParams($names);
            $data['private'] = CheckBox::get($this->request->postParam('private', false));

            if ($this->model->create($data)) {
                $data = [];
            }

            unset($data['user_id'], $data['private']);
            $this->redirect(self::$route->get('category.create'), $data);
        } else {
            $this->view->render('category/create', $this->request->getParams(['name', 'image']));
        }
    }

    public function listAction()
    {
        View::set(['title' => "Moje kategorie", 'style' => 'item']);
        $categories = $this->model->findAll(["user_id" => User::ID()], "ORDER BY name ASC");
        $this->view->render('category/list', ['categories' => $categories, 'url' => $this->request->url()]);
    }

    public function editAction()
    {
        View::set(['title' => "Edycja kategorii"]);

        $category = $this->category(false);
        $names = ['name', 'image'];

        if ($this->request->isPost() && $this->request->hasPostNames($names)) {
            $data = $this->request->postParams($names);
            $data['private'] = CheckBox::get($this->request->postParam('private', false));
            $this->model->edit($data);
            $this->redirect(self::$route->get('category.edit') . "&id=" . $category->id);
        } else {
            $this->view->render("category/edit", ['category' => $category]);
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $this->model->delete($this->category(true));
        } else {
            Session::set('error', 'Błąd dostępu do wybranej akcji');
        }

        $this->redirect(self::$route->get('category.list'));
    }

    public function showAction()
    {
        $category = $this->category(true);
        View::set(['title' => $category->name, 'style' => 'item']);
        $this->view->render('category/show', ['category' => $category, 'manage' => true]);
    }

    public function publicAction()
    {
        if ($category = $this->category(true)) {
            if ($category->private == false) {
                View::set(['title' => $category->name, 'style' => 'item']);
                $this->view->render('category/show', ['category' => $category, 'manage' => false]);
                exit();
            }
        }

        Session::set('error', 'Brak uprawnień do tego zasobu');
        $this->redirect(self::$route->get('home'));
    }

    private function category(bool $relation = true)
    {
        $id = (int) $this->request->param('id');

        if (!$this->model->author($id)) {
            Session::set('error', 'Brak uprawnień do tego zasobu');
            $this->redirect(self::$route->get('category.list'));
        } else {
            $this->model->relation = $relation;
            $category = $this->model->find(["id" => (int) $id]);
        }

        return $category ?? null;
    }
}
