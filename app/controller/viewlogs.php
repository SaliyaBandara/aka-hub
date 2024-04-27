<?php
class ViewLogs extends Controller
{
    public function index()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            $action = "Unauthorized user tried to view Logs and Actions page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'View Logs',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data['logs'] = $this->model('readModel')->readLogEntries();
        $this->view->render('admin/viewLogs/index', $data);
    }

    public function userlogsAnalytics()
    {
        $this->requireLogin();
        if (($_SESSION["user_role"] != 1) && ($_SESSION["user_role"] != 3)) {
            $action = "Unauthorized user tried to view User Logs Analytics page";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'User Logs Analytics',
            'message' => 'Welcome to Aka Hub!'
        ];

        $data['userLogs'] = $this->model('readModel')->getLogAnalytics();
        $data["unauthorized"] = $data['userLogs'][0]["count"];
        $data["created"] = $data['userLogs'][1]["count"];
        $data["deleted"] = $data['userLogs'][2]["count"];   
        $data["logged"] = $data['userLogs'][3]["count"];
        $data["granted"] = $data['userLogs'][4]["count"];
        $data["revoked"] = $data['userLogs'][5]["count"];

        $data["chartOne"]=$this->model('readModel')->getLogAnalyticsChartOne();
        
        $data["chartTwo"]=$this->model('readModel')->getLogAnalyticsChartTwo();

        $data["chartThree"]=$this->model('readModel')->getLogAnalyticsChartThree();

        $data["chartFour"]=$this->model('readModel')->getLogAnalyticsChartFour();

        $data["chartFive"]=$this->model('readModel')->getLogAnalyticsChartFive();

        $this->view->render('admin/viewLogs/userLogAnalytics', $data);
    }
}
