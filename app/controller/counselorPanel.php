<?php

class CounselorPanel extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "User tried to access counselor panel without permission";
            $status = "400";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'CounselorPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('counselor/counselorpanel/index', $data);
    }
}
