<?php
class FeedsSelection extends Controller{
    public function index()
    {
        $this->requireLogin();
        if ($_SESSION["user_role"] != 1){
            $action = "User tried to view feeds selection page";
            $state = 200;
            $this->model("createModel")->createLogEntry($action, $state);
            $this->redirect();
        }
        $data = [
            'title' => 'Feeds Selection',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/feedsSelection/index', $data);
    }

}