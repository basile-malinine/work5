<?php
/**
 *
 * DbAccount - класс-helper, расширяющий DbMysql и реализующий функции-запросы, необходимые
 * для приложения.
 *
 */
require_once 'database/DbMysql.php';

class DbAccounts extends DbMysql {
  public function __construct() {
    DbMysql::__construct();
  }

  private function getHash($pass) {
    return password_hash($pass, PASSWORD_BCRYPT);
  }

  public function getIdByLogin($login) {
    $strSql = 'SELECT `id`
                 FROM `users`
                WHERE `login` = :login';
    $params = [
      'login' => $login,
    ];

    $res = $this->query($strSql, $params);
    if ($res)
      return $res[0]['id'];
    else
      return false;
  }

  public function getIdByEmail($email) {
    $strSql = 'SELECT `id`
                 FROM `users`
                WHERE `email` = :email';
    $params = [
      'email' => $email,
    ];

    $res = $this->query($strSql, $params);
    if ($res)
      return $res[0]['id'];
    else
      return false;
  }

  public function checkPasswordById($id, $pass): bool {
    $rec = $this->getRecById('users', $id);
    if ($rec)
      return password_verify($pass, $rec['password']);
    else
      return false;
  }

  public function changePassById($id, $pass) {
    $pass = $this->getHash($pass);
    $strSql = 'UPDATE `users` 
                  SET `password` = :password,
                      `pass_update` = :pass_update
                WHERE `id` = :id';
    $params = [
      'id' => $id,
      'password' => $pass,
      'pass_update' => date('Y-m-d H:i:s', time()),
    ];
    $res = $this->query($strSql, $params);
    if ($res)
      return $res;
    else
      return false;
  }

  public function changeNameById($id, $name) {
    $strSql = 'UPDATE `users`
                  SET `name` = :name
                WHERE `id` = :id';
    $params = [
      'id' => $id,
      'name' => $name,
    ];
    $res = $this->query($strSql, $params);
    if ($res)
      return $res;
    else
      return false;
  }

  public function insertAccount($login, $email, $name, $pass) {
    $pass = $this->getHash($pass);
    $strSql = 'INSERT INTO `users`
                           (`login`, `email`, `name`, `password`, `pass_update`) 
                    VALUES (:login, :email, :name, :password, :pass_update)';
    $params = [
      'login' => $login,
      'email' => $email,
      'name' => $name,
      'password' => $pass,
      'pass_update' =>  date('Y-m-d H:i:s', time()),
    ];
    $res = $this->query($strSql, $params);
    if ($res)
      return $res;
    else
      return false;
  }
}