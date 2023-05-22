<!DOCTYPE HTML>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="description" content="Описание страницы"/>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
            crossorigin="anonymous"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row justify-content-center py-2">
        <div class="col-4">
            <h1>Регистрация</h1>
            <form action="/register" METHOD="post">
                <div class="mb-3">
                    <label for="name" class="form-label">Имя</label>
                    <input type="text" class="form-control" id="name" name="user[name]">
                </div>
                <div class="mb-3">
                    <label for="login" class="form-label">Логин</label>
                    <input type="text" class="form-control" id="login" name="user[login]">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Пароль</label>
                    <input type="password" class="form-control" id="password" name="user[password]">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Дата рождения</label>
                    <input type="date" class="form-control" id="name" name="user[date_birth]">
                </div>
                <input type="submit" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</div>
</body>
</html>