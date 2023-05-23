<?php

include_once 'autoload.php';

use PavelPlot\App\Controllers\IndexController;
use PavelPlot\App\Request\Request;
use PavelPlot\App\Router\Router;


$router = new Router(Request::generate());

$router->get('/', IndexController::class, 'index');
$router->get('/login', IndexController::class, 'getLoginPage');
$router->post('/login', IndexController::class, 'login');
$router->get('/register', IndexController::class, 'getRegisterPage');
$router->post('/register', IndexController::class, 'registerUser');
$router->get('/profile', IndexController::class, 'getProfilePage');
$router->post('/logout', IndexController::class, 'logout');

$router->run();