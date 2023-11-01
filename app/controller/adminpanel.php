<?php
class AdminPanel extends Controller{
    public function index()
    {
        $this->requireLogin();
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/adminpanel/index', $data);
    }

    public function test(){
        $this->requireLogin();
        $data = [
            'title' => 'AdminPanel',
            'message' => 'Welcome to Aka Hub!'
        ];

        $this->view->render('admin/adminpanel/test', $data);
    }

}