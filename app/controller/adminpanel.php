<?php
class AdminPanel extends Controller
{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["count_total_users"] = $this->model('readModel')->getCountAllUsers();
        $data["count_role_users"] = $this->model('readModel')->getCountRoleUsers();
        $data["count_new_users"] = $this->model('readModel')->getCountNewUsers();
        $data["chartOne"] = $this->model('readModel')->getChartOne();
        $data["chartTwo"] = $this->model('readModel')->getChartTwo();

        $this->view->render('admin/adminpanel/index', $data);
    }
}
