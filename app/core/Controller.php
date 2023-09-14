<?php

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function loadModel($model)
    {
        $file = '../app/model/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model();
        } else {
            // handle error

            // load 404 page
            // TODO: create 404 page
        }
    }
}

class View
{
    protected $data = [];

    public function render($view, $data = [])
    {
        $this->data = $data;
        extract($this->data);
        require_once '../app/view/' . $view . '.php';
        echo '</body></html>';

    }
}
