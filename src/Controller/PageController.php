<?php

declare (strict_types = 1);

namespace App\Controller;

use App\Helper\Request;
use App\Helper\Session;
use App\Model\Page;
use App\Repository\CategoryRepository;
use App\Repository\PageRepository;
use App\Rules\PageRules;
use App\View;

class PageController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->requireLogin();
        $this->repository = new PageRepository();
        $this->categoryRepository = new CategoryRepository();
        $this->rules = new PageRules();
    }

    public function createAction()
    {
        View::set(['title' => "Tworzenie strony"]);
        $category_id = $this->request->param('category_id');

        if ($this->categoryRepository->author($this->user, $category_id)) {
            $names = ['name', 'image', 'link', 'category_id'];
            if ($this->request->isPost() && $this->request->hasPostNames($names)) {
                $data = $this->request->postParams($names);

                if ($this->validate($data, $this->rules)) {
                    $page = new Page($data);
                    $this->repository->create($page);
                    Session::set('success', 'Strona została utworzona');
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

            if (!$author = $this->categoryRepository->author($this->user, $data['category_id'])) {
                Session::set('error:category_id:author', 'Nie jesteś autorem wybranej kategorii');
            }

            if ($this->validate($data, $this->rules) && $author) {
                $page->update($data);
                $this->repository->update($page);
                Session::set('success', 'Dane zostały zaktualizowane');
            }

            $this->redirect(self::$route->get('page.edit') . "&id=" . $page->id);
        } else {
            $this->view->render("page/edit", ['page' => $page, 'categories' => $this->repository->categories($this->user->id)]);
        }
    }

    public function deleteAction()
    {
        $page = $this->page();

        if ($this->request->isPost()) {
            $this->repository->delete($page);
            Session::set('success', 'Strona została usunięta');
        } else {
            Session::set('error', 'Błąd dostępu do wybranej akcji');
        }

        $this->redirect(self::$route->get('category.show') . "&id=" . $page->category_id);
    }

    private function page()
    {
        if ($page = $this->repository->get((int) $this->request->param('id'))) {
            if ($this->categoryRepository->author($this->user, $page->category_id)) {
                return $page;
            }
        }

        Session::set('error', 'Brak uprawnień do tego zasobu');
        $this->redirect(self::$route->get('category.list'));
    }
}
