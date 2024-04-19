<?php
class AdminAccount extends Controller{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 3)
            $this->redirect();

        $data = [
            'title' => 'Admin Account Details',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["role"] = $_SESSION["user_role"];
        $data["admin"] = $this->model('readModel')->getAdmin();
        $this->view->render('superadmin/adminAccount/index', $data);
    }

    public function delete($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 3)
            $this->redirect();

        if ($id == 0)
            $this->redirect();

        $result = $this->model('deleteModel')->deleteOne("user", $id);
        if ($result)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }

}