<?php

include_once 'autoload.php';

use PavelPlot\App\Controllers\IndexController;
use PavelPlot\App\Request\Request;
use PavelPlot\App\Router\Router;


$router = new Router(Request::generate());

$router->get('/', IndexController::class, 'index');
$router->get('/register', IndexController::class, 'getRegisterView');
$router->post('/register', IndexController::class, 'registerUser');

$router->run();