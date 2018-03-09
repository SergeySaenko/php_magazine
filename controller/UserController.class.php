<?php

class UserController extends Controller
{
  public $view = 'user';
  public $title;
  public $msg = '';
  public $form;

	function __construct()
    {
      parent::__construct();
      $this->title .= ' | Личный кабинет';
    }

	public function index()
	{
	  if($_POST) { 
      $this->form = new LoginForm($_POST);
	    if ( $this->form->validate() ) {
	        $email = strip_tags( $this->form->getEmail() );
	        $password = new Password( strip_tags( $this->form->getPassword() ) );

	        $res = User::loginUser($email, $password);
	        if (!$res) {
	            return $msg = 'Нет такого пользователя';
	        } else {
	            $user = $res[0]['username'];
	            Session::set('user', $email);
	            $msg = 'Вы вошли';
	            header('location: ?path=user/room');
	        }

	    } else {
	        $msg = 'Пожалуйста, заполните все поля.';
	    }
	    echo $msg;
	  }  
	}
  
	public function register()
	{
		if($_POST) {
	    $this->form = new RegistrationForm($_POST);
	    if ( $this->form->validate() ) {
	      $email = strip_tags( $this->form->getEmail() );
	      $password = new Password( strip_tags( $this->form->getPassword() ) );

	      $searchUser = User::searchUser($email);
	        if(isset($searchUser[0]['email'])){
	    			$z = $searchUser[0]['email'];
	    			$msg = "Пользователь с такой эл. почтой $z уже существует";
					}else{
	      		$regUserObj = User::registerUser($email, $password);

	      		if($regUserObj){
	      			Session::set('user', $email);
	      			$_SESSION['login'] = $email;
	      			$msg = 'Вы зарегистрировались и вошли';
	        		header('location: ?path=user/room');
	        	}	 
	    		}
	    } else {
	      $msg = 'Please fill in fields';
	    }
	    echo $msg;
    }
	}

	public function room($data)
	{
		return [];
	}
	
}