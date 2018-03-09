<?php 
	class LoginForm
	{
	  private $email;
	  private $password;

	  public function __construct(Array $data)
		{
	  	$this->email = isset($data['email']) ? $data['email'] : null ;
	  	$this->password = isset($data['password']) ? $data['password'] : null ;
		}

    public function validate()
		{
	  	return !empty($this->email) && !empty($this->password);
		}

		public function getEmail()
    {
    	return $this->email;
    }

    public function setEmail($email)
    {
      $this->email = $email;
    }

    public function getPassword()
    {
      return $this->password;
    }

    public function setPassword($password)
    {
      $this->password = $password;
    }
}

?>