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

        if ($this->request->getParam('action') != "public") {
            $this->requireLogin();
        }

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
        $categories = $this->repository->getAll($this->user->id);
        $this->view->render('category/list', ['categories' => $categories, 'url' => $this->request->url()]);
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
                Session::set('success', 'Dane zostały zaktualizowane');
            }

            $this->redirect(self::$route->get('category.edit') . "&id=" . $category->id);
        } else {
            $this->view->render("category/edit", ['category' => $category]);
        }
    }

    public function deleteAction()
    {
        if ($this->request->isPost()) {
            $category = $this->category(true); // MUST BE TRUE
            $this->repository->delete($category);
            Session::set('success', 'Kategoria została usunięta');
        } else {
            Session::set('error', 'Błąd dostępu do wybranej akcji');
        }

        $this->redirect(self::$route->get('category.list'));
    }

    public function showAction()
    {
        $category = $this->category();
        View::set(['title' => $category->name, 'style' => 'item']);
        $this->view->render('category/show', ['category' => $category, 'manage' => true]);
    }

    public function publicAction()
    {
        $id = (int) $this->request->param('id');

        if ($category = $this->repository->get((int) $id, true)) {
            if ($category->private == false) {
                View::set(['title' => $category->name, 'style' => 'item']);
                $this->view->render('category/show', ['category' => $category, 'manage' => false]);
                exit();
            }
        }

        Session::set('error', 'Brak uprawnień do tego zasobu');
        $this->redirect(self::$route->get('home'));
    }

    // =====

    private function category(bool $pages = true)
    {
        $id = (int) $this->request->param('id');
        $category = null;

        if (!$this->repository->author($this->user, $id)) {
            Session::set('error', 'Brak uprawnień do tego zasobu');
            $this->redirect(self::$route->get('category.list'));
        } else {
            $category = $this->repository->get((int) $id, $pages);
        }

        return $category;
    }
}
