<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>

<div class="main">
  <?php
  require_once 'helpers/validation.php';
  require_once 'helpers/DbAccounts.php';

  session_start();

  function clearStr(string $str): string {
    return trim(strip_tags($str));
  }

  $page = '';

  /**
   * Проверка подключения к базе
   * Нет подключения, выводим readme
   */
  try {
    $db = new DbMysql();
  }
  catch (Exception $exception) {
      $page = 'readme';
//    header('Location: readme.inc.php');
  }

  if (isset($_GET['page']))
    $page = $_GET['page'];

  // Селектор страниц
  switch ($page) {
    case 'readme':
        require 'pages/readme.inc.php';
        break;
    // Форма регистрации
    case 'reg':
      require 'pages/registration.inc.php';
      break;
    // Личный кабинет
    case 'acc':
      if (isset($_GET['chg']))
        // Личный кабинет, изменение ФИО
        if ($_GET['chg'] == 'name') {
          require 'pages/chg-name.inc.php';
          break;
        } // Личный кабинет, изменение Пароля
        elseif ($_GET['chg'] == 'password') {
          require 'pages/chg-password.inc.php';
          break;
        } // Личный кабинет, главная
      require 'pages/account.inc.php';
      break;
    // Форма авторизации
    default:
      require 'pages/auth.inc.php';
  }

  ?>
</div>
<div class="footer">
    <div class="copyright">
        Малинин Василий. Тел: +7 (916) 114-5109, Telegram: @BMalina
    </div>
</div>
</body>
</html>
