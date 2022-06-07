<?php
/**
 * Форма Регистрации пользователя
 */
$login = '';
$email = '';
$name = '';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = clearStr($_POST['login']);
  $email = clearStr($_POST['email']);
  $name = clearStr($_POST['name']);
  $pass = clearStr($_POST['password']);
  $passConfirm = clearStr($_POST['password-confirm']);

  // Набор полей для валидации
  $fields = [
    'login' => $login,
    'email' => $email,
    'name' => $name,
    'pass-confirm' => [
      'pass' => $pass,
      'confirm' => $passConfirm,
    ],
  ];

  $valid = validate($fields);

  if ($valid['status']) {
    $db = new DbAccounts();
    $db->insertAccount($login, $email, $name, $pass);
    header('Location: index.php?page=auth');
  } else
    $msg = $valid['msg'];
}

?>

<div class="form-container">
    <div class="form-header">Регистрация</div>
    <form action="../index.php?page=reg" method="post">
        <div class="form-body">
            <!--                              Login -->
            <div class="jr">
                <label for="login">Логин:</label>
            </div>
            <div class="jl">
                <input type="text" id="login" name="login" value="<?= $login ?>">
            </div>
            <!--                              E-mail -->
            <div class="jr">
                <label for="email">E-mail:</label>
            </div>
            <div class="jl">
                <input type="text" id="email" name="email" value="<?= $email ?>">
            </div>
            <!--                              Name -->
            <div class="jr">
                <label for="name">ФИО:</label>
            </div>
            <div class="jl">
                <input type="text" id="name" name="name" value="<?= $name ?>">
            </div>
            <!--                              Password -->
            <div class="jr">
                <label for="password">Пароль:</label>
            </div>
            <div class="jl">
                <input type="password" id="password" name="password">
            </div>
            <!--                              Pass confirmation -->
            <div class="jr">
                <label for="password-confirm">Подтверждение пароля:</label>
            </div>
            <div class="jl">
                <input type="password" id="password-confirm" name="password-confirm">
            </div>
            <!--                              Buttons -->
            <div class="col2"></div>
            <div class="jr">
                <button type="submit">Подтвердить</button>
            </div>
            <div class="jl">
                <a href="index.php">Назад</a>
            </div>
        </div>
    </form>
    <div class="form-alert"><?= $msg ?></div>
</div>
