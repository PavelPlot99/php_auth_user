<?php

namespace PavelPlot\App\Controllers;

use PavelPlot\App\Dtos\UserDto;
use PavelPlot\App\Models\User;
use PavelPlot\App\Request\Request;
use PavelPlot\App\View\View;

class IndexController
{
    private View $view;
    private User $user;

    public function __construct($view)
    {
        $this->view = $view;
        $this->user = new User();
    }

    public function index(Request $request)
    {

    }

    public function getRegisterView(Request $request)
    {
        $this->view->renderHtml('Main/register.php');
    }

    public function registerUser(Request $request){
        $user = UserDto::fromArray($request->getParams()['user']);
        $this->user->create($user->toArray());
    }
}