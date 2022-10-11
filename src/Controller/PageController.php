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
    private $category;

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

        if ($this->category->find(['id' => $category_id, 'user_id' => User::ID()]) != null) {
            if ($data = $this->request->isPost(['name', 'image', 'link', 'category_id'])) {
                if ($this->model->create($data)) {
                    $data = $this->request->postParams(['category_id']);
                }

                $this->redirect('page.create', $data);
            } else {
                $this->view->render('page/create', $this->request->getParams(['name', 'image', 'link', 'category_id']));
            }
        } else {
            Session::error('Brak uprawnień do tego zasobu');
            $this->redirect('category.list');
        }
    }

    public function editAction()
    {
        View::set(['title' => "Edycja strony"]);
        $page = $this->page();

        if ($data = $this->request->isPost(['name', 'image', 'link', 'id', 'category_id'])) {
            if ($page->category_id == $data['category_id'] || $this->category->find(["user_id" => User::ID(), "id" => $data['category_id']])) {
                $page->update($data);
            } else {
                Session::set('error:category_id:author', 'Nie jesteś twórcą wybranej kategorii');
            }

            $this->redirect('page.edit', ['id' => $page->id]);
        } else {
            $this->view->render("page/edit", ['page' => $page, 'categories' => $this->category->findAll(['user_id' => User::ID()])]);
        }
    }

    public function deleteAction()
    {
        $page = $this->page();

        if ($this->request->isPost()) {
            $page->delete();
        } else {
            Session::error('Błąd dostępu do wybranej akcji');
        }

        $this->redirect('category.show', ['id' => $page->category_id]);
    }

    # Method returns page, checking if page exists and we are creator of category
    private function page()
    {
        if ($page = $this->model->findById($this->request->param('id'))) {
            if ($this->category->find(["id" => $page->category_id, "user_id" => User::ID()])) {
                return $page;
            }
        }

        Session::error('Brak uprawnień do tego zasobu');
        $this->redirect('category.list');
    }
}
