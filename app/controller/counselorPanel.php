<?php

class CounselorPanel extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 5) {
            $action = "Unauthorized User tried to access counselor panel without permission";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'CounselorPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["count_total_users"] = $this->model('readModel')->getCountAllUsers();
        $data["count_role_users"] = $this->model('readModel')->getCountRoleUsers();
        $data["count_new_users"] = $this->model('readModel')->getCountNewUsers();
        $data["chartOne"] = $this->model('readModel')->getChartOne();
        $data["chartTwo"] = $this->model('readModel')->getChartTwo();
        $data["chartThree"] = $this->model('readModel')->getChartThree();
        $data["chartFour"] = $this->model('readModel')->getChartFour();
        $data["chartFive"] = $this->model('readModel')->getChartFive();


        $this->view->render('counselor/counselorpanel/index', $data);
    }
}
