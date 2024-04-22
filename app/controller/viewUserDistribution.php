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

    public function previewUser($id)
    {
        $this->requireLogin();
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["user"] = $this->model('readModel')->getPreviewUser($id);
        // print_r($data["user"]);
        $this->view->render('admin/viewUserDistribution/previewUser', $data);
    }
}