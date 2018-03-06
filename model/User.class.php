<?php 

class User extends Model {
  protected static $table = 'users';

  protected static function setProperties()
  {
    self::$properties['id_user'] = [
      'type' => 'int',
      'autoincrement' => true
    ];

    self::$properties['user_login'] = [
      'type' => 'varchar',
      'size' => 50
    ];

    self::$properties['user_password'] = [
      'type' => 'varchar',
      'size' => 100
    ];

    self::$properties['user_last_action'] = [
      'type' => '	timestamp'
    ];
  }

  public static function loginUser($username, $password)
  {
    return db::getInstance()->Select(
      'SELECT * FROM users WHERE user_login=:username AND user_password = :password LIMIT 1',
      ['username' => $username, 'password' => $password]);
    }

}
?>