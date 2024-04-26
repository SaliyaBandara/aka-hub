<?php

class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function redirect($redirect = "")
    {
        $roleToPanel = [
            1 => "adminpanel",
            3 => "adminpanel",
            5 => "counselorPanel"
        ];

        $panel = isset($roleToPanel[$_SESSION["user_role"]]) ? $roleToPanel[$_SESSION["user_role"]] : "";

        $redirectUrl = BASE_URL . "/" . ($panel ? "$panel/" : "") . $redirect;

        header("Location: $redirectUrl");
        die();
    }


    protected function validate($data, $required_vars)
    {
        foreach ($required_vars as $value_name => $value_type) {
            if (!isset($data[$value_name]) || $data[$value_name] == "")
                die(json_encode(array("status" => "400", "desc" => "Please fill all the input fields ($value_name)")));
        }
    }

    protected function validate_template($data, $template)
    {
        foreach ($template as $key => $value) {
            if ($template[$key]["validation"] == "required" && (!isset($data[$key]) || $data[$key] == ""))
                die(json_encode(array("status" => "400", "desc" => "Please fill all the input fields ($key)")));
        }
    }

    // check logged in
    protected function isLoggedIn()
    {
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
            return true;
        return false;
    }

    // require logged in
    protected function requireLogin()
    {
        $uri = (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) ? 'https://' : 'http://';
        $actual_link = $uri . "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        if (!$this->isLoggedIn())
            header("Location: " . BASE_URL . "/auth?redir=" . urlencode($actual_link));
    }

    protected function model($model)
    {
        $file = '../app/model/' . $model . '.php';
        if (file_exists($file)) {
            require_once $file;
            return new $model();
        } else {
            // handle error
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
