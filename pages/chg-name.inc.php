<?php
/**
 * Форма изменения ФИО
 */
$msg = '';
$name = $_SESSION['name'];
$id = $_SESSION['uid'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $name = clearStr($_POST['name']);

  // Набор полей для валидации
  $fields = [
    'name' => $name,
  ];

  // Валидация
  $valid = validate($fields);

  // Если всё хорошо
  if ($valid['status']) {
    $db = new DbAccounts();
    $db->changeNameById($id, $name);
    $_SESSION['name'] = $name;
    header('Location: index.php?page=acc');
  } else
    $msg = $valid['msg'];
}

?>

<div class="form-container">
  <div class="form-header">ФИО - изменить</div>
  <form action="../index.php?page=acc&chg=name" method="post">
    <div class="form-body">
      <!--                              Name -->
      <div class="jr">
        <label for="name">ФИО:</label>
      </div>
      <div class="jl">
        <input type="text" id="name" name="name" value="<?= $name ?>">
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
