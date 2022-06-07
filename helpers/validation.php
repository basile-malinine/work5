<?php
/**
 *
 * Валидация полей из форм
 * Интерфейсная функция validate(array $fields) : array $response
 * $fields массив типа key => value, где key - название проверяемого поля,
 * value - его значение. Названия полей предопределены: 'login' (Логин), 'email' (E-mail), 'name' (ФИО),
 * 'password' (Пароль), 'pass-confirm' (Подтверждение пароля)
 *
 */
require_once 'helpers/DbAccounts.php';

$response = [
  'status' => true,
  'msg' => '',
];

/**
 * <p>Проверка Логина</p>
 *
 * @param $login
 * @return void
 */
function testLogin($login) {
  global $response;

  // Проверка на пустоту
  if ($login == '') {
    $response['status'] = false;
    $response['msg'] = 'Поле Логин должно быть заполнено!';
    return;
  }

  // Проверка на уникальность в базе
  $db = new DbAccounts();
  if ($db->getIdByLogin($login)) {
    $response['status'] = false;
    $response['msg'] = "Учётная запись с Логином $login уже существует";
  }
}

/**
 * <p>Проверка E-mail</p>
 *
 * @param $email
 * @return void
 */
function testEmail($email) {
  global $response;

  // Проверка на пустоту
  if ($email == '') {
    $response['status'] = false;
    $response['msg'] = 'Поле E-mail должно быть заполнено!';
  }

  // Проверка на корректность e-mail (регулярку нашёл в интернете)
  $match = '/^[_a-z\d-]+(\.[_a-z\d-]+)*@[a-z\d-]+(\.[a-z\d-]+)*(\.[a-z]{2,3})$/';
  if (!preg_match($match, $email)){
    $response['status'] = false;
    $response['msg'] = 'В поле E-mail введён некорректный адрес!';
  }

  // Проверка на уникальность в базе
  $db = new DbAccounts();
  if ($db->getIdByEmail($email)) {
    $response['status'] = false;
    $response['msg'] = "Учётная запись с E-mail $email уже существует";
  }
}

/**
 * <p>Проверка ФИО</p>
 *
 * @param $name
 * @return void
 */
function testName($name) {
  global $response;

  // Проверка на пустоту
  if ($name == '') {
    $response['status'] = false;
    $response['msg'] = 'Поле ФИО должно быть заполнено!';
  }
}

/**
 * <p>Проверка Пароля</p>
 *
 * @param $pass
 * @return void
 */
function testPassword($pass) {
  global $response;

  // Проверка на пустоту
  if ($pass == '') {
    $response['status'] = false;
    $response['msg'] = 'Поле Пароль должно быть заполнено!';
  }
}

/**
 * <p>Проверка Подтверждения пароля</p>
 *
 * @param $pass <p>Пароль</p>
 * @param $confirm <p>Подтверждение пароля</p>
 * @return void
 */
function testPassConfirm($pass, $confirm) {
  global $response;

  // Проверка корректности пароля
  testPassword($pass);
  if (!$response['status'])
    return;

  // Проверка подтверждения пароля
  if ($pass != $confirm) {
    $response['status'] = false;
    $response['msg'] = 'Неверное Подтверждение пароля!';
  }
}


/**
 * <p>Селектор по проверяемым полям</p>
 *
 * @param array $fields <p>массив с проверяемыми полями</p>
 * @return array <p>массив: ['status' => true|false,</p><p>'msg' => 'Сообщение об ошибке, если !status']</p>
 */
function validate(array $fields): array {
  global $response;

  foreach ($fields as $key => $value) {
    switch ($key) {
      case 'login':
        testLogin($value);
        break;
      case 'name':
        testName($value);
        break;
      case 'email':
        testEmail($value);
        break;
      case 'password':
        testPassword($value);
        break;
      case 'pass-confirm':
        testPassConfirm($value['pass'], $value['confirm']);
        break;
      default:
    }

    if (!$response['status'])
      return $response;
  }

  return $response;
}
