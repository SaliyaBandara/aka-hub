<?php
class ViewUserDistribution extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["users"] = $this->model('readModel')->getAllUsers();
        $this->view->render('admin/viewUserDistribution/index', $data);
    }
}