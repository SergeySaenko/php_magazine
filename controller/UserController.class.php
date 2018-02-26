<?php

class UserController extends Controller
{
  public $view = 'user';
  public $title;

	function __construct()
    {
      parent::__construct();
      $this->title .= ' | Личный кабинет';
    }
}