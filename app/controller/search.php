<?php
class Search extends Controller
{

    public function redirect($redirect = "")
    {
        header("Location: " . BASE_URL . "/");
        die();
    }

    public function view($id = 0)
    {
        $this->requireLogin();
        $this->redirect();
    }

    public function go($search = "")
    {
        $this->requireLogin();
        $results = [];
        if ($search != "")
            $results = $this->model('readModel')->search($search);
        die(json_encode(array("status" => "200", "desc" => "Success", "results" => $results)));
    }
}
