<?php
/*
* Контроллер функций пользователя
*/

class UserController extends Controller
{
  public $view = 'user';
  public $title;
  public $msg;
  public $form;

	function __construct()
    {
      parent::__construct();
      $this->title .= ' | Личный кабинет';
      $this->form = new LoginForm($_POST);
    }

	public function login($form)
	{
	    if ($form->validate()) {
	        $username = $form->getUsername();
	        $password = new Password( $form->getPassword() );

	        $res = User::loginUser($username, $password);
	        if (!$res) {
	            return [ 'msg' => 'No such user found'];
	        } else {
	            $user = $res[0]['username'];
	            Session::set('user', $user);
	            return [ 'msg' => 'You have been logged in'];
	            //header('location: index.php?msg=You have been logged in');
	        }

	    } else {
	        return [ 'msg' => 'Please fill in fields'];
	    }
	}

	public function register(){
		$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : null;
		$email = trim($email);
		$pwd1 = isset($_REQUEST['pwd1']) ? $_REQUEST['pwd1'] : null;
		$pwd2 = isset($_REQUEST['pwd2']) ? $_REQUEST['pwd2'] : null;
		$phone = isset($_REQUEST['phone']) ? $_REQUEST['phone'] : null;
		$address = isset($_REQUEST['address']) ? $_REQUEST['address'] : null;
		$name = isset($_REQUEST['name']) ? $_REQUEST['name'] : null;
		$name = trim($name);

		$resData = null;
		$resData = User::checkRegisterParams($email, $pwd1, $pwd2);	

		if(!$resData && User::checkUserEmail($email)){
			$resData['success'] = false;
			$resData['message'] = "Пользователь с таким ('{$email}') уже зарегистрирован";
		}
		if (!$resData) {
			$pwdMD5 = md5($pwd1);
			$userData = User::registerNewUser($email, $pwdMD5, $name, $phone, $address);
			if ($userData['success']) {
				$resData['message'] = "Пользователь успешно зарегистрирован";
				$resData['success'] = 1;

				$userData = $userData[0];
				$resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
				$resData['email'] = $email;

				$_SESSION['user'] = $userData;
				$_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
			} else {
				$resData['success'] = 0;
				$resData['message'] = "Ошибка регистрации";
			}
		}
		echo json_encode($resData);
	}
	
}