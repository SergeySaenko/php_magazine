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

  public static function loginUser($email, $password)
  {
    return SQL::Instance()->Select(
      'SELECT * FROM users WHERE email=:email AND pwd = :password LIMIT 1',
      ['email' => $email, 'password' => $password]);
  }

  public static function registerUser($email, $password)
  {
    return SQL::Instance()->Insert(
      'users', ['email'=>$email, 'pwd'=>$password, 'role'=>'2']);
  }

  public static function searchUser($email)
  {
    return SQL::Instance()->Select(
      'SELECT * FROM users WHERE email=:email',
      ['email' => $email]);
  }

}
?>