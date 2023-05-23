<?php
include 'Main/header.php';
?>
<div class="container-fluid">
    <div class="row justify-content-center py-2">
        <div class="col-4">
            <?php if(isset($_COOKIE['login'])){?>
            <h1>Профиль</h1>
                <ul>
                    <li>Имя <?=$_COOKIE['name']?></li>
                    <li>Логин <?=$_COOKIE['login']?></li>
                    <li>Дата рождения <?=$_COOKIE['date_birth']?></li>
                    <li><img width="300" height="400" src="<?=$_COOKIE['image']?>" alt="Фото"> </li>
                </ul>
            <?php }else {?>
                <h1>Страница недоступна неавторизированным пользователям</h1>
            <?php }?>


        </div>
    </div>
</div>
<?php
include 'Main/footer.php'
?>