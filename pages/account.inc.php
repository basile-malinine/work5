<?php
/**
 * Странца Лмчного кабинета
 */
// Если Гость (т.е. не авторизован) переход на авторизацию
if (!isset($_SESSION['uid']))
  header('Location: index.php');

$uid = $_SESSION['uid'];
$login = $_SESSION['login'];
$email = $_SESSION['email'];
$name = $_SESSION['name'];
$passUpdate = $_SESSION['pass_update'];
?>

<div class="form-container">
    <div class="form-header">Личный кабинет</div>
    <div class="account-body">
        <!--                              UID -->
        <div class="jr">
            UID:
        </div>
        <div class="jl">
            <?= $uid ?>
        </div>
        <div></div>

        <!--                              Login -->
        <div class="jr">
            Логин:
        </div>
        <div class="jl">
          <?= $login ?>
        </div>
        <div></div>

        <!--                              Login -->
        <div class="jr">
            E-mail:
        </div>
        <div class="jl">
          <?= $email ?>
        </div>
        <div></div>

        <!--                              Name -->
        <div class="jr">
            ФИО:
        </div>
        <div class="jl">
            <?= $name ?>
        </div>
        <div class="jl">
            <a href="index.php?page=acc&chg=name">[изменить]</a>
        </div>

        <!--                              Password -->
        <div class="jr">
            Пароль:
        </div>
        <div class="jl">
            сохранён <?= $passUpdate ?>
        </div>
        <div class="jl">
            <a href="index.php?page=acc&chg=password">[изменить]</a>
        </div>

        <div class="col2 jr">
            <a href="index.php">Выход</a>
        </div>
        <div>
        </div>
    </div>
</div>

