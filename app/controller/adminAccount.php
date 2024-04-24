<?php
class AdminAccount extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 3) {
            //log Entry
            $action = "Unauthorized user tried to access Admin Account Details";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

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
            $action = "Unauthorized user tried to delete Admin Account";
        $status = "401";
        $this->model("createModel")->createLogEntry($action, $status);
        $this->redirect();

        if ($id == 0)
            $this->redirect();
        $resultOne = $this->model('deleteModel')->deleteOne("administrator", $id);
        $resultTwo = $this->model('deleteModel')->deleteOne("user", $id);
        if ($resultOne && $resultTwo)
            die(json_encode(array("status" => "200", "desc" => "Operation successful")));

        die(json_encode(array("status" => "400", "desc" => "Error while deleting course")));
    }
}
