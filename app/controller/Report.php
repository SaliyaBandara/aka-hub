<?php
class Report extends Controller
{
    public function index()
    {

        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            //log Entry
            $action = "Unauthorized user tried to access Adminpanel";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'Existing Counselors',
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

        $this->view->render('admin/report/adminPanelReport', $data);
    }

    public function userlogsAnalytics(){
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            //log Entry
            $action = "Unauthorized user tried to access Adminpanel";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'User Logs Analytics',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data["chartOne"] = $this->model('readModel')->getChartOne();
        $data["chartTwo"] = $this->model('readModel')->getChartTwo();
        $data["chartThree"] = $this->model('readModel')->getChartThree();
        $data["chartFour"] = $this->model('readModel')->getChartFour();
        $data["chartFive"] = $this->model('readModel')->getChartFive();

        $this->view->render('admin/report/userLogsAnalytics', $data);
    }
}
