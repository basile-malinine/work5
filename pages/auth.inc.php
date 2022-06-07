<?php
/**
 * Форма Авторизации пользователя
 */
// Если сессия не завершена, очистить переменные $_SESSION
if (isset($_SESSION['uid']))
  session_destroy();

$login = '';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $login = clearStr($_POST['login']);
  $pass = clearStr($_POST['password']);


  if ($pass != '' && $login != '') {
    $db = new DbAccounts();
    $id = $db->getIdByLogin($login);

    if ($db->checkPasswordById($id, $pass)) {
      // Если сессия не завершена

      // Записываем в сессию текущего пользователя
      $rec = $db->getRecById('users', $id);
      $_SESSION['uid'] = $id;
      $_SESSION['login'] = $rec['login'];
      $_SESSION['email'] = $rec['email'];
      $_SESSION['name'] = $rec['name'];
      $_SESSION['pass_update'] = $rec['pass_update'];

      // Входим в Личный кабинет
      header('Location: index.php?page=acc');
    } else
      $msg = 'Неверный Логин или Пароль!';
  } else
    $msg = 'Поля Логин и Пароль должны быть заполнены!';
}
?>

<div class="form-container">
    <div class="form-header">Авторизация</div>
    <form action="../index.php" method="post">
        <div class="form-body">
            <!--                              Login -->
            <div class="jr">
                <label for="login">Логин:</label>
            </div>
            <div class="jl">
                <input type="text" id="login" name="login" value="<?= $login ?>">
            </div>
            <!--                              Password -->
            <div class="jr">
                <label for="password">Пароль:</label>
            </div>
            <div class="jl">
                <input type="password" id="password" name="password">
            </div>
            <!--                              Buttons -->
            <div class="col2"></div>
            <div class="jr">
                <button type="submit">Вход</button>
            </div>
            <div class="jl">
                <a href="../index.php?page=reg">Зарегистрироваться</a>
            </div>
        </div>
    </form>
    <div class="form-alert"><?= $msg ?></div>
</div>

