<?php

declare (strict_types = 1);

use App\Model\Route;

$route = new Route();
$route->group('', ['home', 'policy', 'contact', 'regulations']);
$route->group('auth', ['register', 'login', 'forgotPassword', 'resetPassword']);
$route->group('user', ['logout', 'profile', 'update']);
$route->group('category', ['create', 'edit', 'list', 'delete', 'show', 'public']);
$route->group('page', ['create', 'edit', 'delete']);

return $route;
