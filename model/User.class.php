<?php 

/*
* Модель для работы с таблицей users
*/

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

  /*
  * Регистрация нового пользователя
  * 
  * @param string $email
  * @param string $pwdMD5
  * @param string $name
  * @param string $phone
  * @param string $address
  * @return array users data
  */
  public static function registerNewUser($email, $pwdMD5, $name, $phone, $address)
  {
    $email = htmlspecialchars(mysql_real_escape_string($email));//заменить на PDO
    $name = htmlspecialchars(mysql_real_escape_string($name));
    $phone = htmlspecialchars(mysql_real_escape_string($phone));
    $address = htmlspecialchars(mysql_real_escape_string($address));

    $sql = "INSERT INTO 
              users (`email`, `pwd`, `name`, `phone`, `address`)
              VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$address}')";
    $rs = mysql_query($sql);
    
    if($rs){
      $sql = "SELECT * FROM users WHERE ( `email` = '{$email}' and `pwd` = '{$pwdMD5}') LIMIT 1";
      $rs = mysql_query($sql);
      $rs = createSmartyRsArray($rs);

      if(isset($rs[0])){
        $rs['success'] = 1;
      } else {
        $rs['success'] = 0;
      }
    } else {
        $rs['success'] = 0;
    }

    return $rs;
  }

  /*
  * Проверка параметров регистрации пользователя
  */
  public static function checkRegisterParams($email, $pwd1, $pwd2)
  {
    $res = null;

    if(!$email){
      $res['success'] = false;
      $res['message'] = 'Введите email';
    }    

    if(!$pwd1){
      $res['success'] = false;
      $res['message'] = 'Введите пароль';
    }

    if(!$pwd2){
      $res['success'] = false;
      $res['message'] = 'Введите повтор пароля';
    }
  
    if($pwd1 != $pwd2){
      $res['success'] = false;
      $res['message'] = 'Пароли не совпадают';
    }
  return $res;
  }

  public static function checkUserEmail($email)
  {
    $email = htmlspecialchars(mysql_real_escape_string($email));
    $sql = "SELECT id FROM users WHERE email = '{$email}'";
    $rs = mysql_query($sql);
    $rs = createSmartyRsArray($rs);

    return $rs;
  }
}
?>