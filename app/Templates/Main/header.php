<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8" http-equiv="Content-Type" content="text/javascript">
    <title>Title</title>
    <meta name="description" content="Описание страницы"/>
    <div id="notify-container"></div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Меню</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php if(isset($_COOKIE['login'])){?>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/profile">Информация о пользователе</a>
                </li>
                <?php }else {?>
                <li class="nav-item">
                    <a class="nav-link" href="/register">Регистрация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login">Вход</a>
                </li>
                <?php }?>
            </ul>
            <?php if(isset($_COOKIE['login'])){?>
            <form class="d-flex" role="search" method="post" action="/logout">
                <button class="btn btn-outline-success" type="submit">Выход</button>
            </form>
            <?php }?>
        </div>
    </div>
</nav>