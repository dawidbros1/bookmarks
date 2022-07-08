<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\Request;
use App\Helper\Session;
use App\Model\Category;
use App\Model\Page;
use App\Model\User;
use App\View;

class PageController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->requireLogin();
        $this->model = new Page();
        $this->category = new Category();
    }

    public function createAction()
    {
        View::set(['title' => "Tworzenie strony"]);
        $category_id = $this->request->param('category_id');

        $category = $this->category->find(['id' => $category_id, 'user_id' => User::ID()]);

        if ($category != null) {
            $names = ['name', 'image', 'link', 'category_id'];
            if ($this->request->isPost() && $this->request->hasPostNames($names)) {
                $data = $this->request->postParams($names);

                if ($this->model->create($data)) {
                    $data = [];
                }

                unset($data['category_id']);

                $this->redirect(self::$route->get('page.create') . "&category_id=" . $category_id, $data);
            } else {
                $data = $this->request->getParams(['name', 'image', 'link']);
                $data['category_id'] = $category_id;
                $this->view->render('page/create', $data);
            }

        } else {
            Session::set('error', 'Brak uprawnień do tego zasobu');
            $this->redirect('category.list');
        }
    }

    public function editAction()
    {
        View::set(['title' => "Edycja strony"]);
        $page = $this->page();
        $names = ['name', 'image', 'link', 'id', 'category_id'];

        if ($this->request->isPost() && $this->request->hasPostNames($names)) {
            $data = $this->request->postParams($names);
            if (!$author = $this->category->find(["user_id" => User::ID(), "id" => $data['category_id']])) {
                Session::set('error:category_id:author', 'Nie jesteś autorem wybranej kategorii');
            } else {
                $this->model->edit($data);
            }

            $this->redirect(self::$route->get('page.edit') . "&id=" . $page->id);
        } else {
            $this->view->render("page/edit", ['page' => $page, 'categories' => $this->category->findAll(['user_id' => User::ID()])]);
        }
    }

    public function deleteAction()
    {
        $page = $this->page();

        if ($this->request->isPost()) {
            $this->model->delete($page);
        } else {
            Session::set('error', 'Błąd dostępu do wybranej akcji');
        }

        $this->redirect(self::$route->get('category.show') . "&id=" . $page->category_id);
    }

    private function page()
    {
        $id = $this->request->param('id');
        if ($page = $this->model->findById($id)) {
            if ($this->category->find(["id" => $page->category_id, "user_id" => User::ID()])) {
                return $page;
            }
        }

        Session::set('error', 'Brak uprawnień do tego zasobu');
        $this->redirect(self::$route->get('category.list'));
    }
}
