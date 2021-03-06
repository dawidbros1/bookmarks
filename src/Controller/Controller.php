<?php

declare(strict_types=1);

namespace App\Controller;

use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Helper\Request;
use App\Helper\Session;
use App\Model\Config;
use App\Model\Mail;
use App\Model\Route;
use App\Model\User;
use App\Repository\Repository;
use App\Repository\UserRepository;
use App\Validator\Validator;
use App\View;

abstract class Controller extends Validator
{
    protected static $config;
    protected static $route;

    protected $userRepository;
    protected $hashMethod;
    protected $request;
    protected $view;
    protected $user = null;

    public static function initConfiguration(Config $config, Route $route): void
    {
        self::$config = $config;
        self::$route = $route;
    }

    public function __construct(Request $request)
    {
        if (empty(self::$config->get('db'))) {
            throw new ConfigurationException('Configuration error');
        }

        Repository::initConfiguration(self::$config->get('db'));
        Mail::initConfiguration(self::$config->get('mail'));

        $this->hashMethod = self::$config->get('hash.method');
        $this->userRepository = new UserRepository();

        if ($id = Session::get('user:id')) {
            $this->user = $this->userRepository->get((int) $id);
        }

        $this->request = $request;
        $this->view = new View($this->user, self::$route);
    }

    public function run(): void
    {
        try {
            $action = $this->action() . 'Action';
            if (!method_exists($this, $action)) {
                Session::set("error", 'Wybrana akcja nie istnieje');
                $this->redirect("./");
            }

            $this->$action();
        } catch (StorageException $e) {
            $this->view->render('error', ['message' => $e->getMessage()]);
        }
    }

    protected function redirect(string $to, array $params = []): void
    {
        $location = $to;

        if (count($params)) {
            $queryParams = [];
            foreach ($params as $key => $value) {
                if (gettype($value) == "integer") {
                    $queryParams[] = urlencode($key) . '=' . $value;
                } else {
                    $queryParams[] = urlencode($key) . '=' . urlencode($value);
                }
            }

            $location .= ($queryParams = "&" . implode('&', $queryParams));
        }

        header("Location: " . $location);
        exit();
    }

    final private function action(): string
    {
        return $this->request->getParam('action', "home");
    }

    // ===== ===== ===== ===== =====

    final protected function guest()
    {
        if ($this->user != null) {
            Session::set("error", "Strona, na kt??r?? pr??bowa??e?? si?? dosta??, jest dost??pna wy????cznie dla u??ytkownik??w nie zalogowanych.");
            $this->redirect(self::$route->get('home'));
        }
    }

    final protected function requireLogin()
    {
        if ($this->user == null) {
            Session::set('lastPage', $this->request->queryString());
            Session::set("error", "Strona, na kt??r?? pr??bowa??e?? si?? dosta??, wymaga zalogowania si??");
            $this->redirect(self::$route->get('auth.login'));
        }
    }

    final protected function requireAdmin()
    {
        $this->requireLogin();
        Session::clear('lastPage');

        if (!$this->user->isAdmin()) {
            Session::set("error", "Nie posiadasz wystarczaj??cych uprawnie?? do akcji, kt??r?? chcia??e?? wykona??");
            $this->redirect(self::$route->get('home'));
        }
    }

    protected function uploadFile($path, $FILE)
    {
        $target_dir = $path;
        $type = strtolower(pathinfo($FILE['name'], PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($FILE["name"]);

        if (move_uploaded_file($FILE["tmp_name"], $target_file)) {
            return true;
        } else {
            Session::set('error', 'Przepraszamy, wyst??pi?? problem w trakcie wysy??ania pliku');
            return false;
        }
    }

    protected function hash($param, $method = null)
    {
        return hash($method ?? $this->hashMethod, $param);
    }

    protected function hashFile($file)
    {
        $type = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $name = $this->hash(date('Y-m-d H:i:s') . "_" . $file['name']);
        $file['name'] = $name . '.' . $type;
        return $file;
    }
}
