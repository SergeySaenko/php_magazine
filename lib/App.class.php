<?php

class App 
{
    public static function Init() 
    {
        date_default_timezone_set('Europe/Moscow');
        db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));

        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
            self::web(isset($_GET['path']) ? $_GET['path'] : '');
        }
    }
	
  //http://site.ru/index.php?path=news/edit/5
	

	

    protected static function web($url)
    {
        $url = explode("/", $url);
        if (!empty($url[0])) {
            $_GET['page'] = $url[0];//если не гет пас не пуст, то присваиваем гет пейдж первый элемент массива
            if (isset($url[1])) {
                if (is_numeric($url[1])) {//если второй элемент массива число
                    $_GET['id'] = $url[1];// то присваиваем его гет айди
                } else {
                    $_GET['action'] = $url[1];// иначе присваиваем второй элемент массива гет экшн
                }
                if (isset($url[2])) {// если третий элемент массива установлен
                    $_GET['id'] = $url[2];// то присваиваем его гет айди
                }
            }
        }
        else{
            $_GET['page'] = 'Index';//иначе
        }

        if (isset($_GET['page'])) {
            $controllerName = ucfirst($_GET['page']) . 'Controller';//IndexController
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
            $controller = new $controllerName();
            
            $data = [
                'content_data' => $controller->$methodName($_GET),
                'title' => $controller->title,
                'categories' => Category::getCategories(0)
            ];

            $view = $controller->view . '/' . $methodName . '.html';
            if (!isset($_GET['asAjax'])) {
                $loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
                $twig = new Twig_Environment($loader);
                $template = $twig->loadTemplate($view);
                

                echo $template->render($data);
            } else {
                echo json_encode($data);
            }
        }
    }


}