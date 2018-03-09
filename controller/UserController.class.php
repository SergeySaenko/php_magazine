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
      $this->form = new LoginForm($_POST);
    }

	public function login($form)
	{
	    if ($form->validate()) {
	        $username = $form->getUsername();
	        $password = new Password( $form->getPassword() );

	        $res = User::loginUser($form);
	        if (!$res) {
	            $msg = 'No such user found';
	        } else {
	            $user = $res[0]['username'];
	            Session::set('user', $user);
	            $msg = 'You have been logged in';
	            //header('location: index.php?msg=You have been logged in');
	        }

	    } else {
	        $msg = 'Please fill in fields';
	    }
	}
	
}