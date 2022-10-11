<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\Checkbox;
use App\Helper\Request;
use App\Helper\Session;
use App\Model\Category;
use App\Model\Page;
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

        if ($data = $this->request->isPost(['name', 'image'])) {
            $data['private'] = Checkbox::get($this->request->postParam('private', false));

            if ($this->model->create($data)) {
                $data = [];
            }

            $this->redirect('category.create', $data);
        } else {
            $this->view->render('category/create', $this->request->getParams(['name', 'image', 'private']));
        }
    }

    public function listAction()
    {
        View::set(['title' => "Moje kategorie", 'style' => 'item']);
        $categories = $this->model->findAll(["user_id" => User::ID()], "ORDER BY name ASC");
        $this->view->render('category/list', ['categories' => $categories, 'location' => $this->request->url()]);
    }

    public function editAction()
    {
        View::set(['title' => "Edycja kategorii"]);
        $category = $this->category(false);

        if ($data = $this->request->isPost(['name', 'image'])) {
            $data['private'] = Checkbox::get($this->request->postParam('private', false));
            $category->update($data);
            $this->redirect('category.edit', ['id' => $category->id]);
        } else {
            $this->view->render("category/edit", ['category' => $category]);
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $this->category(true)->delete();
        } else {
            Session::error('Błąd dostępu do wybranej akcji');
        }

        $this->redirect('category.list');
    }

    public function showAction()
    {
        $category = $this->category(true);
        $page = new Page([
            'name' => "Dodaj stronę",
            'image' => "public/images/Item/plus.png",
            'link' => self::$route->get('page.create') . "&category_id=$category->id",
        ]);

        # To pages from category we adds item to create page 
        array_unshift($category->pages, $page);

        View::set(['title' => $category->name, 'style' => 'item']);
        $this->view->render('category/show', ['category' => $category, 'manage' => true]);
    }

    public function publicAction()
    {
        if (($category = $this->category(true, false)) && $category->private == false) {
            View::set(['title' => $category->name, 'style' => 'item']);
            $this->view->render('category/show', ['category' => $category, 'manage' => false]);
            exit();
        }

        Session::error('Brak uprawnień do tego zasobu');
        $this->redirect('home');
    }

    private function category(bool $relation = true, $auth = true)
    {
        $id = (int) $this->request->param('id');
        $this->model->relation = $relation;

        if ($auth === true) {
            $category = $this->model->find(["id" => $id, "user_id" => User::ID()]);
        } else {
            $category = $this->model->find(["id" => $id]);
        }

        if ($category == null) {
            Session::error('Brak uprawnień do tego zasobu');
            $this->redirect('category.list');
        }

        return $category;
    }
}
