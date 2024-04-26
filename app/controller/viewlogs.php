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

        $this->view->render('admin/viewLogs/userLogAnalytics', $data);
    }
}
