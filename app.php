<?php
require_once 'autoload.php';
session_start();

try{
    App::init();//выполняем метод инит
}
catch (PDOException $e){
    echo "DB is not available";
    var_dump($e->getTrace());
}
catch (Exception $e){
    echo $e->getMessage();
}
