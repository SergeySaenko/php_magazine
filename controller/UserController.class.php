<?php

class UserController extends Controller
{
  public $view = 'user';
  public $title;
  public $msg = '';
  public $form = new LoginForm($_POST);

	function __construct()
    {
      parent::__construct();
      $this->title .= ' | Личный кабинет';
    }

  public function index($data)
  {
      //$categories = Category::getCategories(isset($data['id']) ? $data['id'] : 0);
      //$goods = Good::getGoods(isset($data['id']) ? $data['id'] : 0);
      return ['subcategories' => $categories, 'goods' => $goods];
  }

  public function goods($data){
      if($data['id'] > 0){
          $good = new Good([
              "id_good" => $data['id']
          ]);

          return $good->getGoodInfo()[0];
      }
      else{
          header("Location: /categories/");
      }
  }

	//$db_host = 'localhost';
	//$db_user = 'root';
	//$db_password = '';
	//$db_name = 'hw5';


	//$db = new DB($db_host, $db_user, $db_password, $db_name);
	//$form = new LoginForm($_POST);

	public function login($form)
	{
	    if ($form->validate()) {
	        $username = $db->escape($form->getUsername());
	        $password = new Password( $db->escape($form->getPassword()) );

	        $res = User::login($data);
	        //$db->query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' LIMIT 1");
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