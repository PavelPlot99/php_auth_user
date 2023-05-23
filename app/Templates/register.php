<?php
include 'Main/header.php'
?>
<div class="container-fluid">
    <div class="row justify-content-center py-2">
        <div class="col-4">
            <h1>Регистрация</h1>
            <form action="/register" METHOD="post" id="register-form">
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
                <input type="submit" class="btn btn-primary" value="Зарегистрироваться">
            </form>
        </div>
    </div>
</div>
<?php
include 'Main/footer.php'
?>