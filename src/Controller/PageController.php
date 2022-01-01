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
            if ($this->request->isPost()) {
                $names = ['name', 'image', 'link', 'category_id'];

                if ($this->request->hasPostNames($names)) {
                    $data = $this->request->postParams($names);

                    if ($this->validate($data, $this->rules)) {
                        $page = new Page($data);
                        $this->repository->create($page);
                        Session::set('success', 'Strona została utworzona');
                        $data = [];
                    }

                    unset($data['category_id']);
                }
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
}
