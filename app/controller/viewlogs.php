<?php
class ViewLogs extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'ViewLogs',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/viewLogs/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'ViewLogs',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/viewLogs/test', $data);
    }

}