<?php
/**
 * Форма изменения Пароля
 */
$msg = '';
$name = $_SESSION['name'];
$id = $_SESSION['uid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $pass = clearStr($_POST['password']);
  $newPass = clearStr($_POST['new-password']);
  $passConfirm = clearStr($_POST['pass-confirm']);

  $db = new DbAccounts();
  // Проверяем текущий пароль в базе
  if ($db->checkPasswordById($id, $pass)) {
    $fields = [
      'pass-confirm' => [
        'pass' => $newPass,
        'confirm' => $passConfirm,
      ],
    ];
    // Проверка совпадения Нового пароля с подтверждением
    $valid = validate($fields);
    // Если совпадают
    if ($valid['status']) {
      // Проверка на совпадение нового с текущим
      if ($pass == $newPass)
        $msg = 'Новый пароль совпадает с текущим!';
      // Если новый отличается от текущего, возвращаемся в ЛК
      else {
        $db->changePassById($id, $newPass);
        $rec = $db->getRecById('users', $id);
        $_SESSION['pass_update'] = $rec['pass_update'];
        header('Location: index.php?page=acc');
      }
    } else
      $msg = $valid['msg'];
  } else
    $msg = 'Текущий пароль введён неверно!';
}
?>

<div class="form-container">
    <div class="form-header"><?= $name ?> - изменить Пароль</div>
    <form action="../index.php?page=acc&chg=password" method="post">
        <div class="form-body">
            <!--                              Текущий пароль -->
            <div class="jr">
                <label for="password">Текущий пароль:</label>
            </div>
            <div class="jl">
                <input type="password" id="password" name="password">
            </div>

            <!--                              Новый пароль -->
            <div class="jr">
                <label for="new-password">Новый пароль:</label>
            </div>
            <div class="jl">
                <input type="password" id="new-password" name="new-password">
            </div>

            <!--                              Подтверждение пароля -->
            <div class="jr">
                <label for="pass-confirm">Подтверждение пароля:</label>
            </div>
            <div class="jl">
                <input type="password" id="pass-confirm" name="pass-confirm">
            </div>

            <!--                              Buttons -->
            <div class="col2"></div>
            <div class="jr">
                <button type="submit">Сохранить</button>
            </div>
            <div class="jl">
                <a href="../index.php?page=acc">Назад</a>
            </div>
        </div>
    </form>
    <div class="form-alert"><?= $msg ?></div>
</div>

