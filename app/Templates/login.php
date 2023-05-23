<?php
include 'Main/header.php'
?>
    <div class="container-fluid">
        <div class="row justify-content-center py-2">
            <div class="col-4">
                <h1>Вход</h1>
                <form action="/login" METHOD="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Логин</label>
                        <input type="text" class="form-control" id="login" name="user[login]">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Пароль</label>
                        <input type="password" class="form-control" id="password" name="user[password]">
                    </div>
                    <input type="submit" value="Войти">
                </form>
            </div>
        </div>
    </div>
<?php
include 'Main/footer.php'
?>