<?php

class App
{
    private $controller;
    private $action;
    private $params;

    public function __construct()
    {
        session_start();
        $this->parseUrl();
        $this->loadController();
        $this->callAction();
    }

    private function parseUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);

        $this->controller = isset($url[0]) && $url[0] != '' ? $url[0] : 'home';
        $this->action = isset($url[1]) ? $url[1] : 'index';
        $this->params = array_slice($url, 2);

        // print_r($this->params);

        // print_r($url);
    }

    private function loadController()
    {
        $file = '../app/controller/' . $this->controller . '.php';
        if (file_exists($file)) {
            require_once $file;
            $this->controller = new $this->controller();
        } else {
            // handle error
            // TODO : create 404 page
            echo "Controller Not Found";

        }
    }

    private function callAction()
    {
        if (method_exists($this->controller, $this->action)) {
            call_user_func_array([$this->controller, $this->action], $this->params);
        } else {
            // handle error
        }
    }
}
