<?php

class AdminView extends Controller
{
    public function index($id = 0)
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 3) {
            $action = "Unauthorized user tried to access Admin Details";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }

        $data = [
            'title' => 'Admin Details',
            'message' => 'Welcome to Aka Hub!'
        ];



        // if (!$data["counselor"])
        //     $this->redirect();
        $data["admin"] = $this->model('readModel')->getOneAdmin($id);
        $this->view->render('superadmin/viewAdminDetails/index', $data);
    }
}
