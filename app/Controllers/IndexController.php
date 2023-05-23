<?php

namespace PavelPlot\App\Controllers;

use mysql_xdevapi\CollectionModify;
use PavelPlot\App\Config;
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

        header('Content-Type: application/json; charset=utf-8');
        $user = UserDto::fromArray($request->getParams()['user']);
        $user_db = $this->user->find('login', $user->login);
        if(count($user_db) > 0){
             echo json_encode([
                'status' => '500',
                'message' => 'Пользователь с таким логином существует',
            ]);
             exit();
        }
        $user->password = password_hash($user->password, PASSWORD_BCRYPT);

        if($_FILES && $_FILES['image']['error'] == UPLOAD_ERR_OK)
        {
            $name = Config::get('image_path')."/".time().".jpg";
            if(!move_uploaded_file($_FILES['image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$name)){
                echo json_encode([
                    'status' => '500',
                    'message' => 'Ошибка при загрузке файла',
                ]);
                exit();
            }
            $user->image = $name;
        }

        $this->user->create($user->toArray());

        echo json_encode([
            'status' => '200',
            'message' => 'Вы успешно зарегистрировались',
        ]);
        exit();

    }

    public function getProfilePage(Request $request)
    {
        $this->view->renderHtml('profile.php');
    }

    public function login(Request $request)
    {
        header('Content-Type: application/json; charset=utf-8');
        $user = UserDto::fromArray($request->getParams()['user']);
        $user_from_db = $this->user->find('login', $user->login);
        if (count($user_from_db) > 0) {
            $user_from_db = $user_from_db[0];
            if(!password_verify($user->password, $user_from_db['password'])){
                echo json_encode([
                    'status' => '500',
                    'message' => 'Неверный пароль',
                ]);
                exit();
            }
            setcookie('name', $user_from_db['name'], time() + 3600);
            setcookie('login', $user_from_db['login'], time() + 3600);
            setcookie('date_birth', $user_from_db['date_birth'], time() + 3600);
            setcookie('image', $user_from_db['image'], time() + 3600);
            echo json_encode([
                'status' => '200',
                'message' => 'Вы успешно вошли',
            ]);
            exit();

        }
        echo json_encode([
            'status' => '500',
            'message' => 'Такого пользователя не существует',
        ]);
        exit();
    }

    public function logout(Request $request)
    {
        if (isset($_COOKIE['login'])) {
            setcookie('name', "", time() - 3600);
            setcookie('login', "", time() - 3600);
            setcookie('login', "", time() - 3600);
            setcookie('date_birth', "", time() - 3600);
            setcookie('image', "", time() - 3600);
        }
        Helper::redirect('/login');
    }
}