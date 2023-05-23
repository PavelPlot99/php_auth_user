<?php

namespace PavelPlot\App\Controllers;

use mysql_xdevapi\CollectionModify;
use PavelPlot\App\Dtos\UserDto;
use PavelPlot\App\Helpers\Helper;
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

    public function getloginPage(Request $request)
    {
        $this->view->renderHtml('login.php');
    }

    public function getRegisterPage(Request $request)
    {
        $this->view->renderHtml('register.php');
    }

    public function registerUser(Request $request)
    {
        $user = UserDto::fromArray($request->getParams()['user']);
        $user->password = password_hash($user->password, PASSWORD_BCRYPT);
        $this->user->create($user->toArray());
        $this->view->renderHtml('login.php');
    }

    public function getProfilePage(Request $request)
    {
        $this->view->renderHtml('profile.php');
    }

    public function login(Request $request)
    {
        $user = UserDto::fromArray($request->getParams()['user']);
        $user_from_db = $this->user->find('login', $user->login);
        if (count($user_from_db) > 0) {
            $user_from_db = $user_from_db[0];
            if(!password_verify($user->password, $user_from_db['password'])){
                Helper::redirect('login');
            }
            setcookie('name', $user_from_db['name'], time() + 3600);
            setcookie('login', $user_from_db['login'], time() + 3600);
            setcookie('date_birth', $user_from_db['date_birth'], time() + 3600);
            Helper::redirect('/profile');
        }
        Helper::redirect('/login');
    }

    public function logout(Request $request)
    {
        if (isset($_COOKIE['login'])) {
            setcookie('name', "", time() - 3600);
            setcookie('login', "", time() - 3600);
            setcookie('login', "", time() - 3600);
            setcookie('date_birth', "", time() - 3600);
        }
        Helper::redirect('/login');
    }
}