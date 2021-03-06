<?php

class App
{
    private $controller = 'HomeController';

    private $method = 'indexAction';

    private $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if(isset($url[0]))
        {
            $url[0] = ucfirst($url[0] . 'Controller');

            if(file_exists('../app/controllers/' . $url[0] . '.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            }
            else
            {
                $layout = '404';
                require_once '../app/views/structure.php';
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            $url[1] = $url[1] . 'Action';

            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
            else
            {
                $layout = '404';
                require_once '../app/views/structure.php';
            }
        }

        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseUrl()
    {
        if(isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}