<?php
class ViewUserDistribution extends Controller{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to view User Distribution";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
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
        if ($_SESSION["user_role"] != 1) {
            $action = "Unauthorized user tried to Preview User Details";
            $status = "401";
            $this->model("createModel")->createLogEntry($action, $status);
            $this->redirect();
        }
        $data = [
            'title' => 'User Distribution',
            'message' => 'Welcome to Aka Hub!'
        ];
        $data["user"] = $this->model('readModel')->getPreviewUser($id);
        $this->view->render('admin/viewUserDistribution/previewUser', $data);
    }
}